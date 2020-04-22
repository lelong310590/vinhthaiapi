<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 4:59 PM
 */

namespace Contact\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

    protected $fillable = [
        'contact_name', 'email', 'phone', 'contact_title', 'content', 'status', 'group'
    ];

    public function getAnswer(){
        return $this->hasOne(Answers::class,'contact_id');
    }
}