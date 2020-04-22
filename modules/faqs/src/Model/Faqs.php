<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 2:44 PM
 */

namespace Faqs\Model;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{
    protected $table = 'faqs_group';

    protected $fillable = [
        'name', 'content', 'status', 'created_at', 'updated_at', 'sort', 'created_by', 'edited_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getFaqsItem()
    {
        return $this->hasMany(FaqsItem::class, 'group', 'id');
    }
}