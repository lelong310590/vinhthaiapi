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
$moduleRoute = 'comment';

//Backend
Route::group(['prefix' => $adminRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->group(['prefix' => $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {

        $router->get('index','CommentController@getIndex')
            ->name('lito::comment.index.get')
            ->middleware('permission:comment_index');

        $router->get('create','CommentController@getCreate')
            ->name('lito::comment.create.get')
            ->middleware('permission:comment_create');

        $router->post('create', 'CommentController@postCreate')
            ->name('lito::comment.create.post')
            ->middleware('permission:comment_create');

        $router->get('edit/{id}','CommentController@getEdit')
            ->name('lito::comment.edit.get')
            ->middleware('permission:comment_edit');

        $router->post('edit/{id}','CommentController@postEdit')
            ->name('lito::comment.edit.post')
            ->middleware('permission:comment_edit');

        $router->get('delete/{id}','CommentController@getDelete')
            ->name('lito::comment.delete.get')
            ->middleware('permission:comment_delete');

        $router->get('status','CommentController@getStatus')
            ->name('lito::comment.status.get');

    });
});
