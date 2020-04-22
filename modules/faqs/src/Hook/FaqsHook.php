<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:11 PM
 */

namespace Faqs\Hook;


class FaqsHook
{
    public function handle()
    {
        echo view('lito-faqs::partials.sidebar');
    }
}