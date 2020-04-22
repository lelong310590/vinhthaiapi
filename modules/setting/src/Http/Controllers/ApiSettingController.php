<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 3:42 PM
 */

namespace Setting\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Setting\Repositories\SettingRepositories;

class ApiSettingController extends BaseController
{
    protected $set;

    public function __construct(SettingRepositories $settingRepositories)
    {
        $this->set = $settingRepositories;
    }

    public function getAllSetting(){
        $settings = $this->set->all([
            'setting_key', 'setting_value'
        ]);

        $result = [];

        foreach ($settings as $s) {
            $result[$s->setting_key] = $s->setting_value;
        }

        return $result;
    }

}