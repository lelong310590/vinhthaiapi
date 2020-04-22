<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 15/03/2019
 * Time: 14:55
 */

namespace TablePrice\Models;

use Illuminate\Database\Eloquent\Model;
use Users\Models\Users;

class TablePrice extends Model
{
    protected $table = 'table_price';

    protected $fillable = [
        'name', 'price', 'sale_price', 'price_type', 'description', 'content', 'status', 'main', 'created_by', 'edited_by',
        'created_at', 'updated_at', 'group','index'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getGroup()
    {
        return $this->belongsTo(TablePriceGroup::class, 'group', 'id');
    }
}