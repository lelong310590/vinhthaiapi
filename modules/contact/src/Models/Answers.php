<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 4:59 PM
 */

namespace Contact\Models;


use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'contact_id', 'content', 'content', 'status'
    ];
}