<?php 
Class InventoryController{
    private $model;
    public function __construct()
    {
        $this->model = new InventoryModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
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
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
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
    public function ShowInventory(){
        $productos = $this->model->getAllProducts();
        Views::render('admin/inventory/inventario', ['productos' => $productos]);
    }
    public function editarProducto(){
        $id = $_GET['id'] ?? null;
        if (!$id || !is_numeric($id)) {
            http_response_code(400);
            Views::render('errors/error_http', [
                'status_code' => 400,
                'title' => 'Solicitud incorrecta',
                'message' => 'ID de producto no válido.'
            ]);
            return;
        }
        $producto = $this->model->getProductById((int)$id);
        if (!$producto) {
            http_response_code(404);
            Views::render('errors/error_http', [
                'status_code' => 404,
                'title' => 'Producto no encontrado',
                'message' => 'No se encontró el producto solicitado.'
            ]);
            return;
        }
        Views::render('admin/inventory/editar_producto', ['producto' => $producto, 'csrf_token' => $_SESSION['csrf_token']]);
    }
    public function updateProducto(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;
            $precio = $_POST['precio'] ?? null;
            $stock = $_POST['stock'] ?? null;
            $imagen = $_FILES['imagen'] ?? null;
            $csrfToken = $_POST['csrf_token'] ?? null;

            if (!$this->isValidCsrf($csrfToken)) {
                header('Location: /admin/inventario/editar?id=' . urlencode($id) . '&error=csrf');
                return;
            }

            if (!$id || !is_numeric($id) || !$nombre || !$descripcion || !$precio || !is_numeric($precio) || !is_numeric($stock) || ($imagen && $imagen['error'] !== UPLOAD_ERR_OK) || $precio <= 0 || $stock < 0) {
                header('Location: /admin/inventario/editar?id=' . urlencode($id) . '&error=validation');
                return;
            }

            $updateData = [
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => (float)$precio,
                'stock' => (int)$stock,
                'imagen' => $imagen && $imagen['error'] === UPLOAD_ERR_OK ? $this->handleImageUpload($imagen) : null
            ];

            // Si hay nueva imagen, obtén la antigua para eliminarla
            if ($updateData['imagen']) {
                $oldProduct = $this->model->getProductById((int)$id);
                if ($oldProduct && $oldProduct['imagen']) {
                    $oldImagePath = __DIR__ . '/../../public/assets/uploads/' . $oldProduct['imagen'];
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
            } else {
                // Si no hay nueva imagen, mantén la anterior
                unset($updateData['imagen']);
            }

            if ($this->model->updateProduct((int)$id, $updateData)) {
                header('Location: /admin/inventario?success=updated');
            } else {
                header('Location: /admin/inventario/editar?id=' . urlencode($id) . '&error=update');
            }
        } else {
            http_response_code(405);
            Views::render('errors/error_http', [
                'status_code' => 405,
                'title' => 'Método no permitido',
                'message' => 'Solo se permiten solicitudes POST para esta acción.'
            ]);
        }
    }
    
    private function handleImageUpload(array $file): ?string {
        $maxSize = 5 * 1024 * 1024; // 5MB
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        
        // Validar tamaño
        if ($file['size'] > $maxSize) {
            return null;
        }
        
        // Validar tipo MIME
        $mimeType = null;
        if (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
        } elseif (function_exists('mime_content_type')) {
            $mimeType = mime_content_type($file['tmp_name']);
        } else {
            $mimeType = $file['type'];
        }
        
        if (!in_array($mimeType, $allowedTypes)) {
            return null;
        }
        
        // Validar extensión
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions)) {
            return null;
        }
        
        // Generar nombre único
        $uniqueName = uniqid('product_', true) . '.' . $extension;
        $uploadDir = __DIR__ . '/../../public/assets/uploads/';
        
        // Crear directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $destination = $uploadDir . $uniqueName;
        
        // Mover archivo
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $uniqueName;
        }
        
        return null;
    }
}