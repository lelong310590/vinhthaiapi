<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 9:40 AM
 */

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

$moduleRoute = 'post';

Route::group([], function (Router $router) use($moduleRoute){

    $router->group(['prefix' => $moduleRoute], function (Router $router) {
        $router->get('get-post-by-category', 'ApiPostController@getPostByTaxonomy');
//            ->middleware('client');

        $router->get('get-post-info','ApiPostController@getPostDetail')
            ->middleware('client');

        $router->get('get-single','ApiPostController@getSinglePost');

        $router->get('get-relate-post','ApiPostController@getRelatePost')
            ->middleware('client');

        $router->get('get-page','ApiPostController@getPage')
            ->middleware('client');

        $router->get('get-video','ApiPostController@getVideo')
            ->middleware('client');

        $router->get('get-video-first','ApiPostController@getVideoFirst')
            ->middleware('client');

        $router->get('get-rating','ApiPostController@getRatingbyPost')
            ->middleware('client');

        $router->post('post-rating','ApiPostController@postRating')
            ->middleware('client');

        $router->get('get-lastest', 'ApiPostController@getLastestPost')
            ->middleware('client');

        $router->get('get-post-template', 'ApiPostController@getPostTemplate')
            ->middleware('client');

        $router->get('get-giang-vien','ApiPostController@getPostbyPostType');

        $router->get('get-post-by-taxonomy-status','ApiPostController@getPostByTaxonomyStatus');

        $router->get('get-post-display','ApiPostController@getPostDisplay');
        $router->get('get-lien-quan','ApiPostController@getLienquan');
        $router->get('get-nha-thuoc','ApiPostController@getNhathuoc');
        $router->get('post-view-ip', 'ApiPostController@getViewPage');

    });

});