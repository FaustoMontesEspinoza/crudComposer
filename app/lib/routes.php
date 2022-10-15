<?php 
$router = new \Bramus\Router\Router();

$dotenv = Dotenv\Dotenv::createImmutable(URL);
$dotenv->load();

//le pasamos el namespace de controllers
$router->setNamespace('Fausto\CrudComposer\controllers');

$router->get('/','Usuario@index');

$router->get('/usuarios','Usuario@create');

$router->post('/usuarios','Usuario@getAll');

$router->post('/usuarios/crear','Usuario@store');

$router->post('/usuarios/actualizar/{id}','Usuario@actualizar');

$router->delete('/usuarios/eliminar/{id}', 'Usuario@eliminar');

$router->get('/usuarios/{id}','Usuario@viewUsuario');

$router->set404('Error@error');

$router->run();

?>