<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 9:40 AM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'comment';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->post('post-comment', 'ApiCommentController@postComment')->middleware('client');
        $router->get('get-comment-by-post', 'ApiCommentController@getCommentByPost')->middleware('client');
    });

});