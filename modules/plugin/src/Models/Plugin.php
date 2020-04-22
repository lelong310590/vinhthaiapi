<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 24/03/2019
 * Time: 17:22
 */

namespace Plugin\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class Plugin extends Model
{
    protected $table = 'plugin';

    protected $fillable = [
        'name', 'description', 'path', 'status', 'core', 'edited_by'
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