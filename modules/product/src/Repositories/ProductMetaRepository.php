<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 5/20/2019
 * Time: 11:34 AM
 */

namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\ProductMeta;

class ProductMetaRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return ProductMeta::class;
    }

    public function getSeoMeta($key,$postid)
    {
        $data = collect(['meta_value' => '']);
        $meta = $this->findWhere(['product_id'=>$postid,'meta_key' => $key], ['meta_value'])->first();
        if (!empty($meta)) {
            $data = $meta->meta_value;
        }
        return $data;
    }

    public function getUpdateMeta($postid,$value){
        $metakey = $this->scopeQuery(function ($e) use($postid){
            return $e->orderBy('id','desc')->select('id','product_id','meta_key','meta_value')
                ->where('product_id',$postid)->get();
        })->all();

        if(!empty($metakey)){
            foreach ($metakey as $key => $val){
                $this->update([
                    'meta_value' => $value[$val->meta_key]
                ], $val->id);
            }
        }
    }

}