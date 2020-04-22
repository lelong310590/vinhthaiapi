<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 11:15 AM
 */

namespace Post\Hook;

class PostHook
{
    public function handle()
    {
        echo view('lito-post::partials.sidebar');
    }
}