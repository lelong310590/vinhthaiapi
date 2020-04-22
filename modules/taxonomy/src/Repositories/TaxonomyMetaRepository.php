<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/18/2019
 * Time: 3:53 PM
 */

namespace Taxonomy\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Taxonomy\Models\TaxonomyMeta;

class TaxonomyMetaRepository extends BaseRepository
{
    public function model()
    {
       return TaxonomyMeta::class;
    }

    public function getSeoMeta($key,$taxonomyid)
    {
        $data = collect(['meta_value' => '']);
        $meta = $this->findWhere(['taxonomy_id'=>$taxonomyid,'meta_key' => $key], ['meta_value'])->first();
        if (!empty($meta)) {
            $data = $meta->meta_value;
        }
        return $data;
    }

    public function getUpdateTaxoMeta($taxonomyid,$value){
        $metakey = $this->scopeQuery(function ($e) use($taxonomyid){
            return $e->orderBy('id','desc')->select('id','taxonomy_id','meta_key','meta_value')
                ->where('taxonomy_id',$taxonomyid)->get();
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