<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/26/2019
 * Time: 2:58 PM
 */

namespace Slider\Hook;


class HistorySlideHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}