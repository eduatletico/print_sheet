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

$router->get('/', function () use ($router) {
  return $router->app->version();
});

// $router->get('products', ['uses' => 'ProductController@showAllProducts']);
// $router->get('products/{id}', ['uses' => 'ProductController@showOneProduct']);

// $router->get('print/{id}', ['uses' => 'PrintSheetController@showOnePrint']);

$router->get('orders', ['uses' => 'OrderController@renderListOrders']);
$router->get('orders/{id}', ['uses' => 'OrderController@renderViewOrder']);
$router->get('orders/print/{id}', ['uses' => 'OrderController@printOrder']);

$router->post('print', ['uses' => 'PrintSheetController@generatePage']);
