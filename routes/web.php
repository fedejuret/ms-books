<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/books', 'BookController@index');
$router->post('/books', 'BookController@store');
$router->get('/books/{bookId}', 'BookController@show');
$router->put('/books/{bookId}', 'BookController@update');
$router->patch('/books/{bookId}', 'BookController@update');
$router->delete('/books/{bookId}', 'BookController@destroy');
