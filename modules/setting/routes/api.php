<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 3:52 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'setting';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get-setting', 'ApiSettingController@getAllSetting')->middleware('client');
    });

});