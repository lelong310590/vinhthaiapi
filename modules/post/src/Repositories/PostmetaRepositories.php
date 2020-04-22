<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/15/2019
 * Time: 2:33 PM
 */

namespace Post\Repositories;


use Post\Models\PostMeta;
use Prettus\Repository\Eloquent\BaseRepository;

class PostmetaRepositories extends BaseRepository
{
    public function model()
    {
        return PostMeta::class;
    }

    public function getSeoMeta($key,$postid)
    {
        $data = collect(['meta_value' => '']);
        $meta = $this->findWhere(['post_id'=>$postid,'meta_key' => $key], ['meta_value'])->first();
        if (!empty($meta)) {
            $data = $meta->meta_value;
        }
        return $data;
    }

    public function getSeoMetaText($key,$postid)
    {
        $data = '';
        $meta = $this->findWhere(['post_id'=>$postid,'meta_key' => $key], ['meta_value'])->first();
        if (!empty($meta)) {
            $data = $meta->meta_value;
        }
        return $data;
    }

    public function getUpdateMeta($postid,$value){
        $metakey = $this->scopeQuery(function ($e) use($postid){
           return $e->orderBy('id','desc')->select('id','post_id','meta_key','meta_value')
               ->where('post_id',$postid)->get();
        })->all();

        if(!empty($metakey)){
            foreach ($metakey as $key => $val){
                $this->update([
                    'meta_value' => $value[$val->meta_key]
                ], $val->id);
            }
        }
    }

    public function updateOrCreateMeta($postid,$value){
        foreach ($value as $key => $val){
            if($val){
                $this->updateOrCreate(
                    ['meta_key'=>$key,'post_id'=>$postid],[
                    'meta_value' => $val,
                ]);
            }
        }
    }

}