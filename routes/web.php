<?php
$router->get('/', 'HomeController@index');
$router->get('/iniciar', 'LoginController@login');
?>