<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 19/03/2019
 * Time: 02:13
 */

namespace Testimonial\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class Testimonial extends Model
{
    protected $table = 'testimonial';

    protected $fillable = [
        'name', 'thumbnail', 'office', 'company', 'content', 'index', 'created_by', 'edited_by', 'created_at', 'updated_at',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getCreatedBy()
    {
        return $this->belongsTo(Users::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getEditedBy()
    {
        return $this->belongsTo(Users::class, 'edited_by', 'id');
    }
}