<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/20/2019
 * Time: 10:33 AM
 */

namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class CategoryMeta extends Model
{
    protected $table = 'category_meta';
    protected $fillable = ['id','category_id','meta_key','meta_value'];
}