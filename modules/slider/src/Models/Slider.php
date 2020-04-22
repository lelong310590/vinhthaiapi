<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:30 PM
 */

namespace Slider\Models;


use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    protected $fillable = ['id','name','type','group_id','thumbnail', 'description','videoframe','content','url','button_name',
        'index','created_by','edited_by','status'];
}