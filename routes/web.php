<?php
$router->get('/', 'HomeController@index');
$router->get('/iniciar', 'AuthController@showLogin');
?>