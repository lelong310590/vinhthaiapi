<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:17 PM
 */

namespace Contact\Hook;


class ContactHook
{
    public function handle()
    {
        echo view('lito-contact::partials.sidebar');
    }
}