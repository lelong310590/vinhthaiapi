<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 3:52 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'setting';


//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','SettingController@getSetting')
            ->name('lito:setting.index.get')
            ->middleware('permission:setting_site');

        $router->post('index','SettingController@postSetting')
            ->name('lito:setting.index.post')
            ->middleware('permission:setting_site');

        $router->get('test-email','SettingController@testEmail')
            ->name('lito:setting.test.post')
            ->middleware('permission:setting_site');

    });
});
