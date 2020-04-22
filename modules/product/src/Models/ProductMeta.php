<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 5/20/2019
 * Time: 11:15 AM
 */

namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class ProductMeta extends Model
{
    protected $table = 'productmeta';
    protected $fillable = ['product_id','meta_key','meta_value'];
}