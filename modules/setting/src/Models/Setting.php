<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 4:26 PM
 */

namespace Setting\Models;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = ['id','setting_key','setting_value'];
}