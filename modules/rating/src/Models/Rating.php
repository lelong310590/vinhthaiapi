<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/30/2019
 * Time: 3:40 PM
 */

namespace Rating\Models;


use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['id','rating','rateable_type','rateable_id','user_id','user_ip'];
}