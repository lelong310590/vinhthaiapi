<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 1:58 PM
 */

namespace Post\Hook;


class PageHook
{
    public function handle()
    {
        echo view('lito-post::partials.page');
    }
}