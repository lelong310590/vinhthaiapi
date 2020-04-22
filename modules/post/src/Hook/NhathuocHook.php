<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 6/5/2019
 * Time: 1:18 PM
 */

namespace Post\Hook;


class NhathuocHook
{
    public function handle()
    {
        echo view('lito-post::partials.nhathuoc');
    }
}