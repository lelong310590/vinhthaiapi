<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:06 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'faqs';
$subModuleRoute = 'faqs-item';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $subModuleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute, $subModuleRoute) {
        $router->get('index', 'FaqsController@getIndex')
            ->name('lito::faqs.index.get')
            ->middleware('permission:faqs_index');

        $router->get('create', 'FaqsController@getCreate')
            ->name('lito::faqs.create.get')
            ->middleware('permission:faqs_create');

        $router->post('create', 'FaqsController@postCreate')
            ->name('lito::faqs.create.post')
            ->middleware('permission:faqs_create');

        $router->get('edit/{id}','FaqsController@getEdit')
            ->name('lito::faqs.edit.get')
            ->middleware('permission:faqs_edit');

        $router->post('edit/{id}', 'FaqsController@postEdit')
            ->name('lito::faqs.edit.post')
            ->middleware('permission:faqs_edit');

        $router->get('delete/{id}', 'FaqsController@getDelete')
            ->name('lito::faqs.delete.get')
            ->middleware('permission:faqs_delete');

        $router->get('status', 'FaqsController@getStatus')
            ->name('lito::faqs.status.get')
            ->middleware('permission:faqs_edit');
    });

    $router->group(['prefix' => $subModuleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('index', 'FaqsItemController@getIndex')
            ->name('lito::faqsitem.index.get')
            ->middleware('permission:faqs_item_index');

        $router->get('create', 'FaqsItemController@getCreate')
            ->name('lito::faqsitem.create.get')
            ->middleware('permission:faqs_item_create');

        $router->post('create', 'FaqsItemController@postCreate')
            ->name('lito::faqsitem.create.post')
            ->middleware('permission:faqs_item_create');

        $router->get('edit/{id}','FaqsItemController@getEdit')
            ->name('lito::faqsitem.edit.get')
            ->middleware('permission:faqs_item_edit');

        $router->post('edit/{id}', 'FaqsItemController@postEdit')
            ->name('lito::faqsitem.edit.post')
            ->middleware('permission:faqs_item_edit');

        $router->get('delete/{id}', 'FaqsItemController@getDelete')
            ->name('lito::faqsitem.delete.get')
            ->middleware('permission:faqs_item_delete');

        $router->get('status', 'FaqsItemController@getStatus')
            ->name('lito::faqsitem.status.get')
            ->middleware('permission:faqs_item_edit');
    });
});