<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 2:16 PM
 */

namespace Post\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Post\Models\Post;
use Post\Repositories\PostRepositories;
use Rating\Models\Rating;
use Rating\Repositories\RatingRepository;
use Taxonomy\Repositories\TaxonomyRepositories;

class ApiPostController extends BaseController
{
    protected $po;
    protected $taxo;
    protected $rate;

    public function __construct(PostRepositories $postRepositories, TaxonomyRepositories $taxonomyRepositories, RatingRepository $ratingRepository)
    {
        $this->po = $postRepositories;
        $this->taxo = $taxonomyRepositories;
        $this->rate = $ratingRepository;
    }

    public function getPostByTaxonomy(Request $request)
    {
        $limit = $request->get('limit');
        $slug = $request->get('slug');
        $order = $request->get('order')?$request->get('order'):'asc';

        try{
            $taxonomy = $this->taxo->findWhere(['slug'=>$slug])->first();

            $meta = $taxonomy->getMeta()->get();
            $ArrMeta = [];
            foreach($meta as $key=>$val){
                $ArrMeta[$val->meta_key] = $val->meta_value;
            }
            $post = $taxonomy->post()->where('post_status','publish')->orderBy('id',$order)->paginate($limit);
            return ['data'=>$post,'meta'=>$ArrMeta,'category'=>$taxonomy];
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    public function getPostByTaxonomyStatus(Request $request){
        try{
            $status = $request->get('status');
            $limit = $request->get('limit');
            $arr = [];
            $taxonomy = $this->taxo
                        ->findWhere([
                            'taxonomy_type'=>'category',
                            'display' => $status
                        ])
                        ->take($limit);

            foreach ($taxonomy as $val){
                $key = [];
                $key['category'] = $val;
                $key['postHot'] = $val->post()->where('display','hot')->first();
                $key['postHome'] = $val->post()->where('display','home')->take(5)->get();
                $arr[] = $key;
            }

            return ['data'=>$arr];
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getPostbyPostType(Request $request){
        try{
            $limit = $request->get('limit');
            $post_type = $request->get('post_type');
            $listGv = $this->po->scopeQuery(function ($e) use($post_type,$limit){
               return $e->orderBy('created_at','desc')->where('post_type',$post_type)->where('post_status','publish')
                   ->take($limit);
            })->all();
            return $listGv;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getPage()
    {
        try{
            $page = $this->po->findWhere(['post_status'=>'publish','post_type'=>'page'])->all();
            return $page;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getVideo()
    {
        try{
            $page = $this->po->findWhere(['post_status'=>'publish','post_type'=>'video'])->all();
            return $page;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getVideoFirst()
    {
        try{
            $page = $this->po->findWhere(['post_status'=>'publish','post_type'=>'video'])->first();
            return $page;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getPostTemplate(Request $request)
    {
        $id = $request->get('id');

        try {
            $post = $this->po->find($id, ['post_template', 'id']);
            $meta = $post->getMeta()->get();
            $metaArr = [];

            foreach ($meta as $k => $m) {
                $metaArr[$m->meta_key] = $m->meta_value;
            }

            return [
                'post' => $post,
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

    public function getSinglePost(Request $request){
        $slug = $request->get('slug');

        try{
            $single = $this->po->with('author')
                ->with('taxonomy')
                ->findWhere(['post_slug'=>$slug])
                ->first();

            if(!empty($single)){
                $meta = $single->getMeta()->get();
                $ArrMeta = [];
                foreach($meta as $key=>$val){
                    $ArrMeta[$val->meta_key] = $val->meta_value;
                }
                return [
                    'data'=>$single,
                    'postmeta'=>$ArrMeta
                ];
            }

            $taxonomy = $this->taxo->findWhere(['slug'=>$slug])->first();

            if(!empty($taxonomy)){
                $meta = $taxonomy->getMeta()->get();
                $ArrMeta = [];
                foreach($meta as $key=>$val){
                    $ArrMeta[$val->meta_key] = $val->meta_value;
                }

                $post = $taxonomy->post()->with('author')->where('post_status','publish')->orderBy('publish_at', 'desc')->paginate(10);

                return [
                    'data' => $taxonomy,
                    'postmeta' => $ArrMeta,
                    'post' => $post
                ];
            }


        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getPostDetail(Request $request)
    {
        $id = $request->get('id');
        try{
            $post_info = $this->po->with('author')->with('taxonomy')->find($id);
            $meta = $post_info->getMeta()->get();
            $metaArr = [];

            foreach ($meta as $k => $m) {
                $metaArr[$m->meta_key] = $m->meta_value;
            }

            $tags = $post_info->taxonomy()->where('taxonomy_type','tag')->get();

            return [
                'data' => $post_info,
                'postmeta' => $metaArr,
                'tags' => $tags
            ];

        } catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getRelatePost()
    {
        try{
            $relatePost = $this->po->scopeQuery(function ($e){
                return $e->orderBy('created_at','desc')->select('id','post_title','post_slug','thumbnail','post_excerpt','created_at','post_status')
                    ->where('post_status','publish')->where('post_type','post')->take(5);
            })->all();
            return $relatePost;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    public function getRatingbyPost(Request $request)
    {
        try {
            $post_id = $request->get('post_id');
            $total = $this->rate->findWhere(['rateable_id'=>$post_id])->avg('rating');
            $trungbinh = [
                '@type' => 'Rating',
                'ratingValue' => floor($total)
            ];

            return $trungbinh;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function getLastestPost(Request $request)
    {
        $post_id = $request->get('id');
        $limit = $request->get('limit');

        try {

            $lastes = $this->po->with('author')->scopeQuery(function ($q) use ($post_id, $limit) {
                return $q->where('post_status', 'publish')->where('post_type','post')->where('id', '!=', $post_id)->where('post_type', 'post')
                        ->orderBy('created_at', 'desc')
                    ->take($limit);
            })->all();

            return $lastes;

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getTaxonomyName(Request $request){

    }

    public function getLienquan(Request $request){
        $slug = $request->get('slug');
        $limit = $request->get('limit');
        try {
            $lienquan = $this->po->scopeQuery(function ($e) use ($slug, $limit) {
                return $e->orderBy('created_at', 'desc')->where('post_type', 'post')
                    ->where('post_status', 'publish')
                    ->where('post_slug', 'like', '%'.$slug.'%')->take($limit);
            })->all();
            return $lienquan;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getPostDisplay(Request $request){
        $display = $request->get('display');
        $limit = $request->get('limit');

        try{
            $data = $this->po->findWhere(['post_status'=>'publish','post_type'=>'post','display'=>$display])->take
            ($limit);
            return $data;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRating(Request $request)
    {
        try{

            $data = [
                'rating' => $request->get('rating'),
                'rateable_id' => $request->get('post_id'),
                'user_ip' => $request->get('user_ip'),
                'rateable_type' => 'Post'
            ];

            if(isset($request->user_id)){
                $data['user_id'] = $request->user_id;
            }else{
                $data['user_id'] = 0;
            }
            $check = Rating::where('user_ip',$request->get('user_ip'))->where('rateable_id',$request->get('post_id'))->first();
            if($check){
                $check->rating = $request->get('rating');
                $check->save();
            }else{
                $this->rate->create($data);
            }


            return response()->json(['message'=>'success'])->setStatusCode(200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getNhathuoc(Request $request){
        try{
            $khuvuc = $this->taxo->with(['post'=>function($e){
                $e->select('post_title','post_slug')->get();
            }])->findWhere(['taxonomy_type'=>'nhathuoc'])->all();
            return $khuvuc;
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }

    }

    public function getViewPage(Request $request){
        $slug = $request->get('slug');
        try{
            $post = $this->po->findWhere(['post_slug'=>$slug])->first();
            $data = ['views'=>$post->views+1];
            $this->po->update($data,$post->id);
            return response()->json(['message' => 'success'])->setStatusCode(200);
        }catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage()])->setStatusCode(500);
        }


    }

}