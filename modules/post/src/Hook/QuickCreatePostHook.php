<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/03/2019
 * Time: 02:04
 */

namespace Post\Hook;

class QuickCreatePostHook
{
    public function handle()
    {
        echo view('lito-post::partials.quickcreate');
    }
}