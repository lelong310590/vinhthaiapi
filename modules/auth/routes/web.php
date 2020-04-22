<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/30/2017
 * Time: 11:07 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'auth';

Route::group([], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->get('forget','AuthController@getForgot')->name('lito::auth.forget.get');
    $router->post('forget','AuthController@postForgot')->name('lito::auth.forget.post');
    $router->get('reset','AuthController@resetPass')->name('lito::auth.reset.get');
    $router->post('reset','AuthController@postResetPass')->name('lito::auth.reset.post');
    $router->get('/', function () use ($adminRoute, $moduleRoute) {
        return redirect()->to($adminRoute );
    });
});

//Backend Route
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->get('/', function () use ($adminRoute, $moduleRoute) {
        return redirect()->to($adminRoute . '/' . $moduleRoute . '/login');
    });

    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('login', 'AuthController@getLogin')->name('lito::auth.login.get');
        $router->post('login', 'AuthController@postLogin')->name('lito::auth.login.post');
        $router->get('logout', 'AuthController@getLogout')->name('lito::auth.logout.get');

        //Google 2FA
        $router->group(['prefix' => '2fa'], function (Router $router) {
            $router->get('validate', 'AuthController@getValidateToken')
                ->name('lito::2fa.validate.get');

            $router->post('validate', 'AuthController@postValidateToken')
                ->name('lito::2fa.validate.post')
                ->middleware('throttle:5');
        });
    });
});