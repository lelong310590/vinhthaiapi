<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:07
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'testimonial';

Route::group([], function (Router $router) use ($moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get', 'ApiTestimonialController@get')->middleware('client');
    });
});