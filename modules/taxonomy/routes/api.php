<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 9:40 AM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'taxonomy';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get-all-taxonomy', 'ApiTaxonomyController@getAllTaxonomy')
               ->middleware('client');

        $router->get('get', 'ApiTaxonomyController@get')
               ->middleware('client');

        $router->get('get-taxonomy-meta', 'ApiTaxonomyController@getTaxonomyMetaTag')
                ->middleware('client');

        $router->get('get-taxonomy-display', 'ApiTaxonomyController@getTaxonomyDisplay')
            ->middleware('client');

    });
});