<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 04/05/2019
 * Time: 10:05
 */

namespace Contact\Hook;

class HistoryContactHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}