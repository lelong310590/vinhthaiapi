<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 9:40 AM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'product';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get-product-category', 'ApiProductController@getProductByCategory');
        $router->get('get-category', 'ApiProductController@getCategory');
        $router->get('get-category-slug', 'ApiProductController@getCategorybySlug');
        $router->get('get-product-info', 'ApiProductController@getProductInfo');
    });

});