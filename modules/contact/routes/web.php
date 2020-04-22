<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:09 PM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'contact';
$subRoute = 'group-contact';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $subRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
        $router->get('detail/{id}','ContactController@getDetail')
            ->name('lito::contact.detail.get')
            ->middleware('permission:contact_view');
        $router->post('answer','ContactController@postAnswer')
            ->name('lito::contact.answer.post');
        $router->get('delete/{id}','ContactController@getDelete')
            ->name('lito::contact.delete.get')
            ->middleware('permission:contact_delete');

    });

    $router->group(['prefix' => $subRoute], function (Router $router) {
        $router->get('index', 'ContactGroupController@getIndex')
               ->name('lito::contactgroup.index.get')
               ->middleware('permission:contact_index');
        $router->get('create', 'ContactGroupController@getCreate')
               ->name('lito::contactgroup.create.get')
               ->middleware('permission:contact_create');
        $router->post('create', 'ContactGroupController@postCreate')
               ->name('lito::contactgroup.create.post')
               ->middleware('permission:contact_create');
        $router->get('edit/{id}', 'ContactGroupController@getEdit')
               ->name('lito::contactgroup.edit.get')
               ->middleware('permission:contact_edit');
        $router->post('edit/{id}', 'ContactGroupController@postEdit')
               ->name('lito::contactgroup.edit.post')
               ->middleware('permission:contact_edit');
        $router->get('delete/{id}', 'ContactGroupController@getDelete')
               ->name('lito::contactgroup.delete.get')
               ->middleware('permission:contact_delete');
    });
});
