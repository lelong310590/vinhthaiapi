<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 15:02
 */

namespace TablePrice\Hook;


class TablePriceHook
{
    public function handle()
    {
        echo view('lito-table-price::partials.sidebar');
    }
}