<?php
$router->get('/', 'HomeController@index');

$router->get('/iniciar', 'AuthController@showForm');
$router->post('/iniciar', 'AuthController@login');
$router->post('/registrar', 'AuthController@register');
?>