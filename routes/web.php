<?php

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

$router->get('/pautas', 'PautaController@getAll');

$router->group(['prefix' => '/pauta'], function () use ($router) {
    $router->get('/{id}', 'PautaController@get');
    $router->post('/', 'PautaController@new');
    $router->put('/{id}', 'PautaController@update');
    $router->delete('/{id}', 'PautaController@remove');
});

$router->group(['prefix' => '/votacao'], function () use ($router) {
    $router->post('/', 'VotacaoController@new');
    $router->get('/resultado/{id}', 'VotacaoController@resultado');
    $router->post('/votar', 'VotacaoController@votar');
});