<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 1:22 PM
 */

namespace Ticket\Models;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';
    protected $fillable = ['id','parent','domain','name','email','title','content','owner','support_name','thumbnail','status','admin_status','type','created_at','updated_by'];
}