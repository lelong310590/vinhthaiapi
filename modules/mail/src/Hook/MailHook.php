<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:42 AM
 */

namespace Mail\Hook;


class MailHook
{
    public function handle()
    {
        echo view('lito-mail::partials.sidebar');
    }
}