<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 28/03/2019
 * Time: 02:01
 */

namespace Acl\Hook;


class QuickCreateRoleHook
{
    public function handle()
    {
        echo view('lito-acl::partials.quickcreate');
    }
}