<?php
session_start();

require_once __DIR__ . '/../core/Router.php';

$router = new Router();

require_once __DIR__ . '/../routes/web.php';

$router->run();

?>