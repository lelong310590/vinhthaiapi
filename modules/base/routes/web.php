<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:51 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'dashboard';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('index', 'DashboardController@getIndex')->name('lito::dashboard.index.get');

        $router->get('clear-cache', 'DashboardController@clearCache')
               ->name('lito::dashboard.clearcache.get');

        $router->get('post-scumar', 'DashboardController@getPostScuma');
        $router->get('post-bai-viet', 'DashboardController@getBaiviet');
    });
});
