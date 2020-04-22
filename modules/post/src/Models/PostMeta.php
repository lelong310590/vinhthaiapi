<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/15/2019
 * Time: 2:25 PM
 */

namespace Post\Models;


use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $table = 'postmeta';
    protected $fillable = ['id','post_id','meta_key','meta_value'];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}