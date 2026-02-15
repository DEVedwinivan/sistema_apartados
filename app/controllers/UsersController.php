<?php 
class UsersController {
    private $model;
    public function __construct(){
        $this->model = new UsersModel();
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
    public function usuarios(){
        $usuarios = $this->model->getAllUsers();
        Views::render('admin/users/usuarios', ['usuarios' => $usuarios, 'csrf_token' => $_SESSION['csrf_token']]);
    }
    public function editarUsuario(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $usuario = $this->model->getUserById((int)$id);
            if ($usuario) {
                Views::render('admin/users/editar_usuarios', ['usuario' => $usuario, 'csrf_token' => $_SESSION['csrf_token']]);
            } else {
                $this->renderHttpError(404, 'Usuario no encontrado', 'El usuario solicitado no existe o fue eliminado.');
            }
        } else {
            $this->renderHttpError(400, 'Solicitud incorrecta', 'No se proporcionó el ID del usuario.');
        }
    }
    public function updateUser(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $email = $_POST['email'] ?? null;
            $csrfToken = $_POST['csrf_token'] ?? null;
            if (!$this->isValidCsrf($csrfToken)) {
                if ($this->isAjaxRequest()) {
                    http_response_code(403);
                    echo json_encode(['success' => false, 'message' => 'Token CSRF inválido']);
                } else {
                    header('Location: /admin/usuarios/editar?id=' . urlencode((string)$id) . '&error=csrf');
                }
                return;
            }
            if ($id && $nombre && $email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $success = $this->model->updateUser((int)$id, $nombre, $email);
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => $success]);
                } else {
                    if ($success) {
                        header('Location: /admin/usuarios?updated=1');
                    } else {
                        header('Location: /admin/usuarios/editar?id=' . urlencode((string)$id) . '&error=save');
                    }
                }
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
                } else {
                    header('Location: /admin/usuarios/editar?id=' . urlencode((string)$id) . '&error=validation');
                }
            }
        } else {
            http_response_code(405);
            if ($this->isAjaxRequest()) {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            } else {
                $this->renderHttpError(405, 'Método no permitido', 'El método HTTP utilizado no está permitido para esta ruta.');
            }
        }
    }
    public function eliminarUsuario(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $csrfToken = $_POST['csrf_token'] ?? null;
            if (!$this->isValidCsrf($csrfToken)) {
                if ($this->isAjaxRequest()) {
                    http_response_code(403);
                    echo json_encode(['success' => false, 'message' => 'Token CSRF inválido']);
                } else {
                    header('Location: /admin/usuarios?error=csrf');
                }
                return;
            }
            if ($id) {
                $success = $this->model->deleteUser((int)$id);
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => $success]);
                } else {
                    if ($success) {
                        header('Location: /admin/usuarios?deleted=1');
                    } else {
                        header('Location: /admin/usuarios?error=delete');
                    }
                }
            } else {
                if ($this->isAjaxRequest()) {
                    echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado']);
                } else {
                    header('Location: /admin/usuarios?error=validation');
                }
            }
        } else {
            http_response_code(405);
            if ($this->isAjaxRequest()) {
                echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            } else {
                $this->renderHttpError(405, 'Método no permitido', 'El método HTTP utilizado no está permitido para esta ruta.');
            }
        }
    }
}
?>