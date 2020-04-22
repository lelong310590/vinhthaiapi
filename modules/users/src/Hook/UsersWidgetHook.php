<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 17/03/2019
 * Time: 13:17
 */

namespace Users\Hook;

use Users\Models\Users;

class UsersWidgetHook
{
    public function handle()
    {
        $user = Users::where('status', 'active')->count();
        echo view('lito-users::partials.widget-dashboard', [
            'total' => $user
        ]);
    }
}