<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/31/2017
 * Time: 11:51 PM
 */
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

Route::middleware('auth:api')->get('/user', function (Router $router) {
    //return $request->user();
});

Route::middleware('client')->get('/search', 'ApiBaseController@search');
