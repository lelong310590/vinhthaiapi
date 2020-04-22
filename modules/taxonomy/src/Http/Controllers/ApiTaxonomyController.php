<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 3:05 PM
 */

namespace Taxonomy\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Post\Repositories\PostRepositories;
use Taxonomy\Repositories\TaxonomyMetaRepository;
use Taxonomy\Repositories\TaxonomyRepositories;

class ApiTaxonomyController extends BaseController
{
    protected $repository;
    protected $post;
    protected $taxMeta;

    public function __construct(
        TaxonomyRepositories $taxonomyRepositories,
        PostRepositories $postRepositories,
        TaxonomyMetaRepository $taxonomyMetaRepository
    )
    {
        $this->repository = $taxonomyRepositories;
        $this->post = $postRepositories;
        $this->taxMeta = $taxonomyMetaRepository;
    }

    public function getAllTaxonomy()
    {
       try{
           $taxonomy = $this->repository->scopeQuery(function ($e){
               return $e->orderBy('index','asc')->select('id','name','slug','parent','index')
                   ->where('taxonomy_type','category')->get();
           })->all();
           return $taxonomy;
       }catch (\Exception $e){
           return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
       }
    }

    public function getTaxonomyDisplay(Request $request){
        $display = $request->get('display');
        $limit = $request->get('limit');
        try{
            $data = $this->repository->scopeQuery(function ($e) use($display,$limit){
                return $e->orderBy('index','asc')->select('id','name','slug','parent','index')
                    ->where('status','active')->where('taxonomy_type','category')->where('display',$display)->take
                    ($limit);
            })->all();
            return $data;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function getTaxonomyMetaTag(Request $request)
    {
        $id = $request->get('id');

        try {
            $meta = $this->taxMeta->findWhere([
                'taxonomy_id' => $id
            ]);
            $metaArr = [];
            foreach ($meta as $k => $m) {
                $metaArr[$m->meta_key] = $m->meta_value;
            }

            return [
                'meta' => $metaArr
            ];

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function get(Request $request)
    {
        $id = $request->get('id');
        $limit = $request->get('limit');

        try {
            $taxonomy = $this->repository->find($id);
            $taxonomy['post_template'] = 'taxonomy';
            $meta = $taxonomy->getMeta()->get();
            $metaArr = [];
            foreach ($meta as $k => $m) {
                $metaArr[$m->meta_key] = $m->meta_value;
            }

            $post = $taxonomy->post()->with('author')->where('post_status', 'publish')->where('post_type', 'post')->orderBy('publish_at', 'desc')->paginate($limit);
//
            return [
                'data' => $taxonomy,
                'postmeta' => $metaArr,
                'post' => $post
            ];

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

}