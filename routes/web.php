<?php
$router->get('/', 'HomeController@index');

$router->get('/iniciar', 'AuthController@showForm');
$router->post('/iniciar', 'AuthController@login');
$router->post('/registrar', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

//Rutas de administrador
$router->get('/admin/usuarios', 'UsersController@usuarios');
$router->get('/admin/usuarios/editar', 'UsersController@editarUsuario');
$router->post('/admin/usuarios/update', 'UsersController@updateUser');
$router->post('/admin/usuarios/eliminar', 'UsersController@eliminarUsuario');
$router->get('/admin/subir_producto', 'UploadproductsController@formProductos');
$router->post('/admin/upload_products', 'UploadproductsController@uploadProduct');
?>