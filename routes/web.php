<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});





$router->get('/ver/tipo/{tipo}','LibrosController@search');
$router->get('/ver/id/{id}','LibrosController@show');

$router->get('/listado','LibrosController@index');
$router->post('/crear','LibrosController@store');
$router->post('/actualizar/{id}','LibrosController@update');
$router->delete('/borrar/{id}','LibrosController@delete');

