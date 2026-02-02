<?php
class AuthController {
    private $model;
    public function __construct()
    {
        $this->model = new AuthModel();
    }
    public function showForm(){
        Views::render('auth/login');

    }
    public function login(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location:". BASE_URL . "iniciar");
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


}
?>