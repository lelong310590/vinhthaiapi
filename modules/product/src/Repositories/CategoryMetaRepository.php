<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/20/2019
 * Time: 10:37 AM
 */

namespace Product\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Product\Models\CategoryMeta;

class CategoryMetaRepository extends BaseRepository
{
    public function model()
    {
        return CategoryMeta::class;
    }

    public function getSeoMeta($key,$taxonomyid)
    {
        $data = collect(['meta_value' => '']);
        $meta = $this->findWhere(['category_id'=>$taxonomyid,'meta_key' => $key], ['meta_value'])->first();
        if (!empty($meta)) {
            $data = $meta->meta_value;
        }
        return $data;
    }

    public function getUpdateTaxoMeta($taxonomyid,$value){
        $metakey = $this->scopeQuery(function ($e) use($taxonomyid){
            return $e->orderBy('id','desc')->select('id','category_id','meta_key','meta_value')
                ->where('category_id',$taxonomyid)->get();
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