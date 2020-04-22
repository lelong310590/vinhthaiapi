<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/23/2019
 * Time: 11:28 AM
 */

namespace Slider\Models;


use Illuminate\Database\Eloquent\Model;

class GroupSlide extends Model
{
    protected $table = 'slider_group';
    protected $fillable = ['id','name','content','index','status','created_by','edited_by'];
}