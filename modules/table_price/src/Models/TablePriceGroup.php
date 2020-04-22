<?php
/**
 * Created by PhpStorm.
 * User: train
 * Date: 02/04/2019
 * Time: 14:26
 */

namespace TablePrice\Models;

use Illuminate\Database\Eloquent\Model;

class TablePriceGroup extends Model
{
    protected $table = 'table_price_group';

    protected $fillable = [
        'name', 'slug', 'status', 'index', 'created_by', 'edited_by', 'created_by', 'edited_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getTablePrice()
    {
        return $this->hasMany(TablePrice::class, 'group', 'id');
    }
}