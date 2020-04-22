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
$moduleRoute = 'menu';
$nodeRoute = 'menu-node';
//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute, $nodeRoute) {

    //type menu
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','MenuController@getIndex')
            ->name('lito::menu.index.get')
            ->middleware('permission:menu_index');
        $router->get('create','MenuController@getCreate')
            ->name('lito::menu.create.get')
            ->middleware('permission:menu_create');
        $router->post('create', 'MenuController@postCreate')
            ->name('lito::menu.create.post')
            ->middleware('permission:menu_create');
        $router->get('edit/{id}','MenuController@getEdit')
            ->name('lito::menu.edit.get')
            ->middleware('permission:menu_edit');
        $router->post('edit/{id}','MenuController@postEdit')
            ->name('lito::menu.edit.post')
            ->middleware('permission:menu_edit');
        $router->get('delete/{id}','MenuController@getDelete')
            ->name('lito::menu.delete.get')
            ->middleware('permission:menu_delete');
    });

    //node menu
    $router->group(['prefix'=> $nodeRoute] , function(Router $router) use ($adminRoute,$nodeRoute){

        $router->get('index','MenuNodeController@getIndex')
            ->name('lito::node.index.get')
            ->middleware('permission:menu_index');
        $router->get('create','MenuNodeController@getCreate')
            ->name('lito::node.create.get')
            ->middleware('permission:menu_create');
        $router->post('create', 'MenuNodeController@postCreate')
            ->name('lito::node.create.post')
            ->middleware('permission:menu_create');
        $router->get('edit/{id}','MenuNodeController@getEdit')
            ->name('lito::node.edit.get')
            ->middleware('permission:menu_edit');
        $router->post('edit/{id}','MenuNodeController@postEdit')
            ->name('lito::node.edit.post')
            ->middleware('permission:menu_edit');
        $router->get('delete/{id}','MenuNodeController@getDelete')
            ->name('lito::node.delete.get')
            ->middleware('permission:menu_delete');
        
        $router->get('status','MenuNodeController@getStatus')
            ->name('lito::node.status.get')
            ->middleware('permission:menu_edit');

    });

});
