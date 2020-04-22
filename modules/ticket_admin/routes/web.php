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
$moduleRoute = 'ticket_admin';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','TicketAdminController@getIndex')
            ->name('lito::ticket_admin.index.get')
            ->middleware('permission:ticket_admin_index');

        $router->get('create','TicketAdminController@getCreate')
            ->name('lito::ticket_admin.create.get')
            ->middleware('permission:ticket_admin_create');

        $router->post('create', 'TicketAdminController@postCreate')
            ->name('lito::ticket_admin.create.post')
            ->middleware('permission:ticket_admin_create');

        $router->get('view/{id}','TicketAdminController@getEdit')
            ->name('lito::ticket_admin.view.get')
            ->middleware('permission:ticket_admin_edit');

        $router->post('view/{id}','TicketAdminController@postEdit')
            ->name('lito::ticket_admin.view.post')
            ->middleware('permission:ticket_admin_edit');

        $router->get('delete/{id}','TicketAdminController@getDelete')
            ->name('lito::ticket_admin.delete.get')
            ->middleware('permission:ticket_admin_delete');

        $router->get('status', 'TicketAdminController@getStatus')
            ->name('lito::ticket_admin.status.get')
            ->middleware('permission:ticket_admin_edit');

    });
});