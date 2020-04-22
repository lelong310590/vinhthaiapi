<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:24 PM
 */

namespace Comment\Models;


use Illuminate\Database\Eloquent\Model;
use Post\Models\Post;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['id','post_id','name','phone','email','comment_content','thumbnail','website','comment_type','parent','approved'];

    public function postInfo(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

}