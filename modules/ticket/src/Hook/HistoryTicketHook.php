<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 1:35 PM
 */

namespace Ticket\Hook;


class HistoryTicketHook
{
    public function handle()
    {

    }

    public static function createHis($desc,$method,$module)
    {
        createHistory($desc, $method, $module);
    }
}