<?php
class AuthController {
    private $model;
    public function __construct()
    {
        $this->model = new AuthModel();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    private function isValidCsrf(?string $token): bool{
        return isset($_SESSION['csrf_token']) && is_string($token) && hash_equals($_SESSION['csrf_token'], $token);
    }
    public function showForm(){
        Views::render('auth/login');

    }
    public function login(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location:". BASE_URL . "iniciar");
            exit;
        }
        if (!$this->isValidCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['error'] = 'Sesión inválida. Intenta de nuevo.';
            header("Location:" . BASE_URL . "iniciar");
            exit;
        }
        $email = trim($_POST['emailL'] ?? '');
        $password = $_POST['passwordL'] ?? '';

        $user = $this->model->login($email, $password);
            
        if (!$user) {
            $_SESSION['error'] = 'Correo o contraseña incorrectos';
            header("Location:" . BASE_URL . "iniciar");
            exit;
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'rol' => $user['rol']
        ];

        header('Location:' . BASE_URL);
        exit;
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
            header("Location:". BASE_URL ."iniciar");
            exit;
        }
        if (!$this->isValidCsrf($_POST['csrf_token'] ?? null)) {
            $_SESSION['error'] = 'Sesión inválida. Intenta de nuevo.';
            header("Location:" . BASE_URL . "iniciar");
            exit;
        }

        if ($this->model->findByEmail($_POST['emailR'])) {
            $_SESSION['error'] = 'El correo ya esta registrado';
            header("Location:". BASE_URL ."iniciar");
            exit;
        }
        $this->model->register([
            'nombre' => trim($_POST['nombreR'] ?? ''),
            'email' => trim($_POST['emailR'] ?? ''),
            'password' => $_POST['passwordR'] ?? ''
        ]);

        $_SESSION['success'] = 'Cuenta creada exitosamente. Por favor inicia sesión.';
        header("Location:". BASE_URL ."iniciar");
        exit;
    }

    public function logout(){
        session_destroy();
        header("Location:". BASE_URL ."iniciar");
        exit;
    }


}
?>