<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 9:40 AM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'slider';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get-slider', 'ApiSliderController@getSlider');
        $router->get('get-qc', 'ApiSliderController@getQc');
    });


});