<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 25/03/2019
 * Time: 11:21
 */

namespace Media\Hook;

class MediaHook
{
    public function handle()
    {
        echo view('lito-media::partials.sidebar');
    }
}