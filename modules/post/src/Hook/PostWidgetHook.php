<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/18/2019
 * Time: 2:14 PM
 */

namespace Post\Hook;

use Post\Models\Post;

class PostWidgetHook
{
    public function handle(){

        $post = Post::where('post_type','post')->where('post_status', 'publish')->count();
        $page = Post::where('post_type','page')->where('post_status', 'publish')->count();

        echo view('lito-post::partials.widget-post', [
                'postnum' => $post,
                'pagenum' => $page
            ]);
    }
}