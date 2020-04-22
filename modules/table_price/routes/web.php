<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 14:53
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'table-price';
$subModule = 'table-price-group';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $subModule) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) {

        $router->get('index','TablePriceController@getIndex')
            ->name('lito::tableprice.index.get')
            ->middleware('permission:table_price_index');

        $router->get('create','TablePriceController@getCreate')
            ->name('lito::tableprice.create.get')
            ->middleware('permission:table_price_create');

        $router->post('create', 'TablePriceController@postCreate')
            ->name('lito::tableprice.create.post')
            ->middleware('permission:table_price_create');

        $router->get('edit/{id}','TablePriceController@getEdit')
            ->name('lito::tableprice.edit.get')
            ->middleware('permission:table_price_edit');

        $router->post('edit/{id}','TablePriceController@postEdit')
            ->name('lito::tableprice.edit.post')
            ->middleware('permission:table_price_edit');

        $router->get('delete/{id}','TablePriceController@getDelete')
            ->name('lito::tableprice.delete.get')
            ->middleware('permission:table_price_delete');

        $router->get('status', 'TablePriceController@getStatus')
            ->name('lito::tableprice.status.get')
            ->middleware('permission:table_price_edit');

        $router->get('main', 'TablePriceController@getMain')
            ->name('lito::tableprice.main.get')
            ->middleware('permission:table_price_edit');

    });

    $router->group(['prefix' => $subModule], function (Router $router) {

        $router->get('index','TablePriceGroupController@getIndex')
            ->name('lito::tablepricegroup.index.get')
            ->middleware('permission:table_price_group_index');

        $router->get('create','TablePriceGroupController@getCreate')
            ->name('lito::tablepricegroup.create.get')
            ->middleware('permission:table_price_group_create');

        $router->post('create', 'TablePriceGroupController@postCreate')
            ->name('lito::tablepricegroup.create.post')
            ->middleware('permission:table_price_group_create');

        $router->get('edit/{id}','TablePriceGroupController@getEdit')
            ->name('lito::tablepricegroup.edit.get')
            ->middleware('permission:table_price_group_edit');

        $router->post('edit/{id}','TablePriceGroupController@postEdit')
            ->name('lito::tablepricegroup.edit.post')
            ->middleware('permission:table_price_group_edit');

        $router->get('delete/{id}','TablePriceGroupController@getDelete')
            ->name('lito::tablepricegroup.delete.get')
            ->middleware('permission:table_price_group_delete');

        $router->get('status', 'TablePriceGroupController@getStatus')
            ->name('lito::tablepricegroup.status.get')
            ->middleware('permission:table_price_group_edit');

    });
});