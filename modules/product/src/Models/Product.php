<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 10:20 PM
 */

namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['id','name','slug','product_code','class_name','price','discount','thumbnail',
        'excerpt','content','status'];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category');
    }

    public function getMeta()
    {
        return $this->hasMany(ProductMeta::class, 'product_id', 'id');
    }

}