<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:06 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'faqs';

Route::group([], function (Router $router) use ($moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get', 'ApiFaqsController@get')->middleware('client');
        $router->get('get-all', 'ApiFaqsController@getAll')->middleware('client');
        $router->get('get-all-faq', 'ApiFaqsController@getAllFaq')->middleware('client');
    });
});