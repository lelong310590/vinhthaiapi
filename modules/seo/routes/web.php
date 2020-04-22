<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 01/04/2019
 * Time: 09:22
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'seo';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','SeoController@getIndex')
            ->name('lito::seo.index.get')
            ->middleware('permission:seo_index');
    });
});