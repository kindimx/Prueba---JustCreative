<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', 'AuthController@authenticate');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/check', 'AuthController@check');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/pedidos', 'PedidosController@index');
    Route::post('/pedidos/crear-pedido', 'PedidosController@store');
    Route::get('/pizzas', 'PizzasController@index');
});
