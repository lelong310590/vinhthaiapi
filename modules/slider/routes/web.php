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
$moduleRoute = 'slider';
$groupRoute = 'groupslide';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $groupRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','SliderController@getIndex')
            ->name('lito::slider.index.get')
            ->middleware('permission:slider_index');

        $router->get('create','SliderController@getCreate')
            ->name('lito::slider.create.get')
            ->middleware('permission:slider_create');

        $router->post('create','SliderController@postCreate')
            ->name('lito::slider.create.post')
            ->middleware('permission:slider_create');

        $router->get('edit/{id}','SliderController@getEdit')
            ->name('lito::slider.edit.get')
            ->middleware('permission:slider_edit');

        $router->post('edit/{id}','SliderController@postEdit')
            ->name('lito::slider.edit.post')
            ->middleware('permission:slider_edit');

        $router->get('delete/{id}','SliderController@getDelete')
            ->name('lito::slider.delete.get')
            ->middleware('permission:slider_delete');

        $router->get('status','SliderController@getStatus')
            ->name('lito::slider.status.get')
            ->middleware('permission:slider_edit');

    });

    $router->group(['prefix' => $groupRoute], function (Router $router) use ($adminRoute, $groupRoute) {

        $router->get('index','GroupSlideControllers@getList')
            ->name('lito::group.list.get')
            ->middleware('permission:slider_index');

        $router->get('create','GroupSlideControllers@getCreate')
            ->name('lito::group.create.get')
            ->middleware('permission:slider_create');

        $router->post('create','GroupSlideControllers@postCreate')
            ->name('lito::group.create.post')
            ->middleware('permission:slider_create');

        $router->get('edit/{id}','GroupSlideControllers@getEdit')
            ->name('lito::group.edit.get')
            ->middleware('permission:slider_edit');

        $router->post('edit/{id}','GroupSlideControllers@postEdit')
            ->name('lito::group.edit.post')
            ->middleware('permission:slider_edit');

        $router->get('delete/{id}','GroupSlideControllers@getDelete')
            ->name('lito::group.delete.get')
            ->middleware('permission:slider_delete');

        $router->get('status','GroupSlideControllers@getStatus')
            ->name('lito::group.status.get')
            ->middleware('permission:slider_edit');

    });

});
