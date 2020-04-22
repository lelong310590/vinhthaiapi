<?php
/**
 * Created by PhpStorm.
 * User: Wiseman
 * Date: 5/20/2019
 * Time: 2:56 PM
 */

namespace Product\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Product\Repositories\CategoryRepository;
use Product\Repositories\ProductRepository;

class ApiProductController extends BaseController
{
    protected $product;
    protected $cate;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->product = $productRepository;
        $this->cate = $categoryRepository;
    }

    public function getProductByCategory(Request $request){
        $limit = $request->get('limit');
        $category = $this->cate->with('product')->scopeQuery(function($e) use ($limit){
            return $e->orderBy('index','asc')->where('parent',0)->take($limit);
        })->all();

        return $category;
    }

    public function getCategory(Request $request){
        $id = $request->get('category');
        $limit = $request->get('limit');
        try {
            $categoryInfo = $this->cate->find($id);
            $product = $categoryInfo->product()->where('status', 'active')->orWhere('status', 'new')->paginate($limit);
            $categoryMeta = $categoryInfo->getMeta()->get();
            $ArrMeta = [];
            foreach($categoryMeta as $key=>$val){
                $ArrMeta[$val->meta_key] = $val->meta_value;
            }
            return ['category' => $categoryInfo, 'categoryMeta'=>$ArrMeta, 'product' => $product];
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getCategorybySlug(Request $request){
        $slug = $request->get('slug');
        $limit = $request->get('limit');
        try{
            $category = $this->cate->findWhere(['slug'=>$slug])->first();
            $product = $category->product()->where('status','active')->paginate($limit);
            $cateMeta = $category->getMeta()->get();
            $ArrMeta = [];
            foreach($cateMeta as $key=>$val){
                $ArrMeta[$val->meta_key] = $val->meta_value;
            }
            return ['category'=>$category,'categoryMeta'=>$ArrMeta,'product'=>$product];
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }
    }

    public function getProductInfo(Request $request){
        $id = $request->get('product_id');
        try{
            $product = $this->product->find($id);
            $productMeta = $product->getMeta()->get();
            $ArrMeta = [];
            foreach($productMeta as $key=>$val){
                $ArrMeta[$val->meta_key] = $val->meta_value;
            }
            return ['product'=>$product,'productMeta'=>$ArrMeta];
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()])->setStatusCode(500);
        }


    }

}