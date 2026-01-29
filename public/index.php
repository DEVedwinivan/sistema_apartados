<?php
session_start();
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Router.php';
define('BASE_URL', 'http://localhost:8000/');
define('ROOT', dirname(__DIR__));
$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->run();

?>