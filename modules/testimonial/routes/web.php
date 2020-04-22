<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:07
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'testimonial';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','TestimonialController@getIndex')
            ->name('lito::testimonial.index.get')
            ->middleware('permission:testimonial_index');

        $router->get('create','TestimonialController@getCreate')
            ->name('lito::testimonial.create.get')
            ->middleware('permission:testimonial_create');

        $router->post('create', 'TestimonialController@postCreate')
            ->name('lito::testimonial.create.post')
            ->middleware('permission:testimonial_create');

        $router->get('edit/{id}','TestimonialController@getEdit')
            ->name('lito::testimonial.edit.get')
            ->middleware('permission:testimonial_edit');

        $router->post('edit/{id}','TestimonialController@postEdit')
            ->name('lito::testimonial.edit.post')
            ->middleware('permission:testimonial_edit');

        $router->get('delete/{id}','TestimonialController@getDelete')
            ->name('lito::testimonial.delete.get')
            ->middleware('permission:testimonial_delete');

        $router->get('status', 'TestimonialController@getStatus')
            ->name('lito::testimonial.status.get')
            ->middleware('permission:testimonial_edit');

    });
});