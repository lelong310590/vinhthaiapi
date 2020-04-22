<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 16:45
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'plugin';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','PluginController@getIndex')
            ->name('lito::plugin.index.get')
            ->middleware('permission:plugin_index');

        $router->get('status', 'PluginController@getStatus')
            ->name('lito::plugin.status.get')
            ->middleware('permission:plugin_edit');
    });
});
