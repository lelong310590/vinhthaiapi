<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 4:17 PM
 */

namespace Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuNode extends Model
{
    protected $table = 'menu_node';

    protected $fillable = [
        'id', 'menu_id', 'parent', 'name', 'slug', 'menu_type', 'type_id', 'url', 'index', 'status', 'created_by', 'edited_by',
        'target', 'is_home'
    ];

    /**
     * @param $value
     */
    public function setIsHomeAttribute($value)
    {
        $boolean = ($value == '1') ? true : false;
        $this->attributes['is_home'] = $boolean;
    }
}