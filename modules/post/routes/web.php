<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 2/21/2019
 * Time: 3:52 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'post';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        //page
        $router->get('page','PostController@getIndex')
            ->name('lito::page.index.get')
            ->middleware('permission:post_index');
        //endpage
        $router->get('index','PostController@getIndex')
            ->name('lito::post.index.get')
            ->middleware('permission:post_index');

        $router->get('create','PostController@getCreate')
            ->name('lito::post.create.get')
            ->middleware('permission:post_create');

        $router->post('create', 'PostController@postCreate')
            ->name('lito::post.create.post')
            ->middleware('permission:post_create');

        $router->get('edit/{id}','PostController@getEdit')
            ->name('lito::post.edit.get')
            ->middleware('permission:post_edit');

        $router->post('edit/{id}','PostController@postEdit')
            ->name('lito::post.edit.post')
            ->middleware('permission:post_edit');

        $router->get('delete/{id}','PostController@getDelete')
            ->name('lito::post.delete.get')
            ->middleware('permission:post_delete');

        $router->get('ajaxtag','PostController@ajaxgetTag')
            ->name('lito::post.ajaxtag.get');
        $router->get('status','PostController@getStatus')
            ->name('lito::post.status.get');

    });
});
