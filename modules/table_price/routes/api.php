<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 14:53
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'table-price';

Route::group([], function (Router $router) use ($moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get', 'ApiTablePriceController@get')->middleware('client');
        $router->get('get-by-group', 'ApiTablePriceController@getByGroup')->middleware('client');
    });
});