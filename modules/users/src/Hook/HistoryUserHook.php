<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/26/2019
 * Time: 3:20 PM
 */

namespace Users\Hook;

class HistoryUserHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}