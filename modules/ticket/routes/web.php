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
$moduleRoute = 'ticket';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','TicketController@getIndex')
            ->name('lito::ticket.index.get')
            ->middleware('permission:ticket_index');

        $router->get('create','TicketController@getCreate')
            ->name('lito::ticket.create.get')
            ->middleware('permission:ticket_create');

        $router->post('create', 'TicketController@postCreate')
            ->name('lito::ticket.create.post')
            ->middleware('permission:ticket_create');

        $router->get('view/{id}','TicketController@getEdit')
            ->name('lito::ticket.view.get')
            ->middleware('permission:ticket_edit');

        $router->post('view/{id}','TicketController@postEdit')
            ->name('lito::ticket.view.post')
            ->middleware('permission:ticket_edit');

        $router->get('delete/{id}','TicketController@getDelete')
            ->name('lito::ticket.delete.get')
            ->middleware('permission:ticket_delete');

        $router->get('status', 'TicketController@getStatus')
            ->name('lito::ticket.status.get')
            ->middleware('permission:ticket_edit');

    });
});