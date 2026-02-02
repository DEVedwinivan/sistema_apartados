<?php
spl_autoload_register(function($class){
    $paths = [
        ROOT . '/app/controllers/',
        ROOT . '/app/models/',
        ROOT . '/core/',
        ROOT .'/config/',
    ];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

?>