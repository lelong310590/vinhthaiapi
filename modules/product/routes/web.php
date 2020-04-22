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
$moduleRoute = 'product';
$categoryRoute = 'category';
//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $categoryRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','ProductController@getIndex')
            ->name('lito::product.index.get')
            ->middleware('permission:product_index');

        $router->get('create','ProductController@getCreate')
            ->name('lito::product.create.get')
            ->middleware('permission:product_create');

        $router->post('create', 'ProductController@postCreate')
            ->name('lito::product.create.post')
            ->middleware('permission:product_create');

        $router->get('edit/{id}','ProductController@getEdit')
            ->name('lito::product.edit.get')
            ->middleware('permission:product_edit');

        $router->post('edit/{id}','ProductController@postEdit')
            ->name('lito::product.edit.post')
            ->middleware('permission:product_edit');

        $router->get('delete/{id}','ProductController@getDelete')
            ->name('lito::product.delete.get')
            ->middleware('permission:product_delete');
    });

    //category
    $router->group(['prefix'=> $categoryRoute], function(Router $router) use($adminRoute,$categoryRoute){

        $router->get('index','CategoryController@getIndex')
           ->name('lito::category.index.get')
           ->middleware('permission:category_index');

        $router->get('create','CategoryController@getCreate')
            ->name('lito::category.create.get')
            ->middleware('permission:category_create');

        $router->post('create','CategoryController@postCreate')
            ->name('lito::category.create.post')
            ->middleware('permission:category_create');

        $router->get('edit/{id}','CategoryController@getEdit')
            ->name('lito::category.edit.get')
            ->middleware('permission:category_edit');

        $router->post('edit/{id}','CategoryController@postEdit')
            ->name('lito::category.edit.post')
            ->middleware('permission:category_edit');

        $router->get('delete/{id}','CategoryController@getDelete')
            ->name('lito::category.delete.get')
            ->middleware('permission:category_delete');

        $router->get('status','CategoryController@getStatus')
            ->name('lito::category.status.get');

    });

});
