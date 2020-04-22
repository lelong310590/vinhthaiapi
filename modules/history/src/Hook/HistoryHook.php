<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 10:07 PM
 */

namespace History\Hook;


class HistoryHook
{
    public function handle()
    {
        echo view('lito-history::partials.sidebar');
    }
}