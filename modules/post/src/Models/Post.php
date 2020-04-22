<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 3:25 PM
 */

namespace Post\Models;

use Illuminate\Database\Eloquent\Model;
use Rating\Models\Rating;
use Taxonomy\Models\Taxonomy;
use Users\Models\Users;
use willvincent\Rateable\Rateable;
use Carbon\Carbon;

class Post extends Model
{
    use Rateable;
    protected $table = 'post';
    protected $fillable = [
        'post_video','id','post_title','post_slug','post_excerpt','post_content','thumbnail','post_author','post_type',
        'post_template','post_status', 'edited_by','publish_at','display','views'
    ];

    public function setPublishAtAttribute($value)
    {
        $published_at = strtotime(str_replace('/', '-', $value));
        $published_at = Carbon::createFromTimestamp($published_at);
        $this->attributes['publish_at'] = $published_at;
    }

    public function getTaxonomy()
    {
        return $this->belongsTo(Taxonomy::class, 'taxonomy_id', 'id');
    }

    public function taxonomy()
    {
        return $this->belongsToMany(Taxonomy::class, 'post_taxonomy', 'post_id', 'taxonomy_id');
    }

    public function getMeta()
    {
        return $this->hasMany(PostMeta::class, 'post_id', 'id');
    }

    public function updateMeta($key)
    {
        $this->getMeta()->select('meta_value')->where('meta_key', $key)->first();
    }

    public function author()
    {
        return $this->belongsTo(Users::class,'post_author','id');
    }

    public function getRating(){
        return $this->hasMany(Rating::class,'rateable_id','id');
    }

}