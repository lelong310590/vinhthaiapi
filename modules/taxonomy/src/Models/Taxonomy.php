<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 11:43 AM
 */

namespace Taxonomy\Models;

use Illuminate\Database\Eloquent\Model;
use Post\Models\Post;

class Taxonomy extends Model
{
    protected $table = 'taxonomy';

    protected $fillable = [
        'id','name', 'thumbnail','parent','slug','taxonomy_type','excerpt','index','status','created_by','edited_by',
        'display',
        'created_at', 'edited_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_taxonomy', 'taxonomy_id', 'post_id');
    }

    public function postHome()
    {
        return $this->post()
            ->where('post.display','home')->take(5);
    }

    public function postHot(){
        return $this->post()
            ->where('post.display', 'hot')->take(1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getMeta()
    {
        return $this->hasMany(TaxonomyMeta::class, 'taxonomy_id', 'id');
    }

}