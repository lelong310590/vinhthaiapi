<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:53 AM
 */

namespace Mail\Models;


use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mail';
    protected $fillable = ['id','name','content'];
}