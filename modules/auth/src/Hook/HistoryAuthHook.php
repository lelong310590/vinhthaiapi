<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/26/2019
 * Time: 3:26 PM
 */

namespace Auth\Hook;


class HistoryAuthHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}