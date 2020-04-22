<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 2:24 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'users';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index', 'UsersController@getIndex')
            ->name('lito::users.index.get')
            ->middleware('permission:user_index');

        $router->get('create', 'UsersController@getCreate')
            ->name('lito::users.create.get')
            ->middleware('permission:user_create');

        $router->post('create', 'UsersController@postCreate')
            ->name('lito::users.create.post')
            ->middleware('permission:user_create');

        $router->get('edit/{id}', 'UsersController@getEdit')
            ->name('lito::users.edit.get')
            ->middleware('permission:user_edit');

        $router->post('edit/{id}', 'UsersController@postEdit')
            ->name('lito::users.edit.post')
            ->middleware('permission:user_edit');

        $router->get('delete/{id}', 'UsersController@getDelete')
            ->name('lito::users.delete.get')
            ->middleware('permission:user_delete');

        $router->get('status', 'UsersController@getStatus')
            ->name('lito::users.status.get')
            ->middleware('permission:user_edit');

        $router->get('enable', 'Google2FAController@enableTwoFactor')
            ->name('lito::2fa.enable');

        $router->get('disable', 'Google2FAController@disableTwoFactor')
            ->name('lito::2fa.disable');

        $router->post('disable', 'Google2FAController@disableTwoFactorPost')
            ->name('lito::2fa.disable.post');
    });
});

