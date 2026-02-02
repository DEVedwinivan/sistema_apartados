<?php
session_start();
define('BASE_URL', 'http://localhost:8000/');
define('ROOT', dirname(__DIR__));
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Views.php';
require_once __DIR__ . '/../app/autoload.php';
$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->run();

?>