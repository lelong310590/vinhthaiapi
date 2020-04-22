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
$moduleRoute = 'taxonomy';


//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','TaxonomyController@getIndex')
            ->name('lito::taxonomy.index.get')
            ->middleware('permission:taxonomy_index');

        $router->get('create','TaxonomyController@getCreate')
            ->name('lito::taxonomy.create.get')
            ->middleware('permission:taxonomy_create');

        $router->post('create', 'TaxonomyController@postCreate')
            ->name('lito::taxonomy.create.post')
            ->middleware('permission:taxonomy_create');

        $router->get('edit/{id}','TaxonomyController@getEdit')
            ->name('lito::taxonomy.edit.get')
            ->middleware('permission:taxonomy_edit');

        $router->post('edit/{id}','TaxonomyController@postEdit')
            ->name('lito::taxonomy.edit.post')
            ->middleware('permission:taxonomy_edit');

        $router->get('delete/{id}','TaxonomyController@getDelete')
            ->name('lito::taxonomy.delete.get')
            ->middleware('permission:taxonomy_delete');

        $router->get('status','TaxonomyController@getStatus')
            ->name('lito::taxonomy.status.get')
            ->middleware('permission:taxonomy_edit');

    });
});
