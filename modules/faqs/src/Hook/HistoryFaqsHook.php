<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/26/2019
 * Time: 2:44 PM
 */

namespace Faqs\Hook;


class HistoryFaqsHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}