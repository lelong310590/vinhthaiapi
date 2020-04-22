<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/26/2017
 * Time: 11:29 AM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$adminRoute = config('base.admin_route');
$moduleRoute = 'acl';

Route::group(['prefix' => $adminRoute.'/'.$moduleRoute], function(Router $router) use ($adminRoute, $moduleRoute) {
	$router->group(['prefix' => 'role'], function(Router $router) {
		$router->get('index', 'RoleController@getIndex')
		       ->name('lito::role.index.get')
		       ->middleware('permission:role_index');
		
		$router->get('create', 'RoleController@getCreate')
		       ->name('lito::role.create.get')
		       ->middleware('permission:role_create');
		
		$router->post('create', 'RoleController@postCreate')
		       ->name('lito::role.create.post')
		       ->middleware('permission:role_create');
		
		$router->get('edit/{id}', 'RoleController@getEdit')
		       ->name('lito::role.edit.get')
		       ->middleware('permission:role_edit');
		
		$router->post('edit/{id}', 'RoleController@postEdit')
		       ->name('lito::role.edit.post')
		       ->middleware('permission:role_edit');
		
		$router->get('delete/{id}', 'RoleController@getDelete')
		       ->name('lito::role.delete.get')
		       ->middleware('permission:role_delete');
	});
	
	$router->group(['prefix' => 'permission'], function(Router $router) {
		$router->get('index', 'PermissionController@getIndex')
		       ->name('lito::permission.index.get')
		       ->middleware('permission:permission_index');
	});
});
