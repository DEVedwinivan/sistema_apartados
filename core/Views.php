<?php
Class Views {
    public static function render(string $view, array $data = []){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        if (!array_key_exists('csrf_token', $data)) {
            $data['csrf_token'] = $_SESSION['csrf_token'];
        }
        extract($data);

        $hidesidebar = in_array($view,[
            'errors/error_http'
        ]);
        require ROOT . '/app/views/layouts/header.php';
        if (!$hidesidebar) {
            require ROOT . '/app/views/layouts/sidebar.php';
        }
        require ROOT . '/app/views/'. $view . '.php';
        require ROOT . '/app/views/layouts/footer.php';
    }
}
?>