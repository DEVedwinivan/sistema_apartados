<?php
class UploadproductsController {
    private $model;
    public function __construct(){
        $this->model = new UploadproductsModel();
        if (session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== 'admin') {
            http_response_code(403);
            Views::render('errors/error_http', [
                'status_code' => 403,
                'title' => 'Acceso denegado',
                'message' => 'No tienes permisos para acceder a esta sección.'
            ]);
            exit;
        }
    }
    private function isValidCsrf(?string $token): bool{
        return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
    }
    private function isAjaxRequest(): bool{
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
    private function renderHttpError(int $code, string $title, string $message): void{
        http_response_code($code);
        Views::render('errors/error_http', [
            'status_code' => $code,
            'title' => $title,
            'message' => $message
        ]);
    }
    public function formProductos(){
        Views::render('admin/subir_producto/subir_producto', ['csrf_token' => $_SESSION['csrf_token']]);
    }
    
    public function uploadProduct(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;
            $precio = $_POST['precio'] ?? null;
            $stock = $_POST['stock'] ?? null;
            $csrfToken = $_POST['csrf_token'] ?? null;
            
            // Validar CSRF
            if (!$this->isValidCsrf($csrfToken)) {
                header('Location: /admin/subir_producto?error=csrf');
                return;
            }
            
            // Validar datos básicos
            if (!$titulo || !$descripcion || !$precio || !is_numeric($precio) || !is_numeric($stock) || $precio <= 0 || $stock <= 0) {
                header('Location: /admin/subir_producto?error=validation');
                return;
            }
            
            // Validar archivo de imagen
            if (!isset($_FILES['img_product']) || $_FILES['img_product']['error'] !== UPLOAD_ERR_OK) {
                header('Location: /admin/subir_producto?error=upload');
                return;
            }
            
            $file = $_FILES['img_product'];
            $maxSize = 5 * 1024 * 1024; // 5MB
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            
            // Validar tamaño
            if ($file['size'] > $maxSize) {
                header('Location: /admin/subir_producto?error=size');
                return;
            }
            
            // Validar tipo MIME
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (!in_array($mimeType, $allowedTypes)) {
                header('Location: /admin/subir_producto?error=type');
                return;
            }
            
            // Validar extensión
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($extension, $allowedExtensions)) {
                header('Location: /admin/subir_producto?error=extension');
                return;
            }
            
            // Generar nombre único y seguro
            $uniqueName = uniqid('product_', true) . '.' . $extension;
            $uploadDir = __DIR__ . '/../../storage/uploads/';
            
            // Crear directorio si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $destination = $uploadDir . $uniqueName;
            
            // Mover archivo
            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                header('Location: /admin/subir_producto?error=move');
                return;
            }
            
            // Guardar en base de datos
            $success = $this->model->createProduct(
                htmlspecialchars($titulo, ENT_QUOTES, 'UTF-8'),
                htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8'),
                (float)$precio,
                (int)$stock,
                $uniqueName
            );
            
            if ($success) {
                header('Location: /admin/subir_producto?success=1');
            } else {
                // Eliminar archivo si falla el guardado en BD
                unlink($destination);
                header('Location: /admin/subir_producto?error=database');
            }
        } else {
            http_response_code(405);
            $this->renderHttpError(405, 'Método no permitido', 'El método HTTP utilizado no está permitido para esta ruta.');
        }
    }
}

?>