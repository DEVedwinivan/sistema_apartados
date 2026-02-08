<?php
$router->get('/', 'HomeController@index');

$router->get('/iniciar', 'AuthController@showForm');
$router->post('/iniciar', 'AuthController@login');
$router->post('/registrar', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

//Rutas de administrador
$router->get('/admin/usuarios', 'AdminController@usuarios');
$router->get('/admin/usuarios/editar', 'AdminController@editarUsuario');
$router->post('/admin/usuarios/update', 'AdminController@updateUser');
$router->post('/admin/usuarios/eliminar', 'AdminController@eliminarUsuario');

?>