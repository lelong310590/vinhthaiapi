<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 03/05/2019
 * Time: 10:35
 */

namespace Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    protected $table = 'contact_group';

    protected $fillable = [
        'name', 'created_at', 'updated_at'
    ];

    public function getContact()
    {
        return $this->hasMany(Contact::class, 'group', 'id');
    }
}