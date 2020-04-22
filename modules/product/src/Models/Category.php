<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 10:22 PM
 */

namespace Product\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['id','name','parent','slug','excerpt','thumbnail','index','status'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'category', 'product_id');
    }

    public function getMeta()
    {
        return $this->hasMany(CategoryMeta::class, 'category_id', 'id');
    }

}