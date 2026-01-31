<?php
Class Views {
    public static function render(string $view, array $data = []){
        extract($data);

        $hidesidebar = in_array($view,[
            'errors/404'
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