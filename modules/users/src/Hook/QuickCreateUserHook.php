<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/03/2019
 * Time: 01:54
 */

namespace Users\Hook;

class QuickCreateUserHook
{
    public function handle()
    {
        echo view('lito-users::partials.quickcreate');
    }
}