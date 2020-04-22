<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 10:24 PM
 */

namespace Product\Http\Controllers;


use Barryvdh\Debugbar\ServiceProvider;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Product\Http\Requests\ProductValidate;
use Product\Models\ProductMeta;
use Product\Repositories\CategoryRepository;
use Product\Repositories\ProductMetaRepository;
use Product\Repositories\ProductRepository;

class ProductController extends ServiceProvider
{
    protected $product;
    protected $cate;
    protected $meta;

    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository,
                                ProductMetaRepository $productMetaRepository)
    {
        $this->product = $productRepository;
        $this->cate = $categoryRepository;
        $this->meta = $productMetaRepository;
    }

    public function getIndex(){
        $data = $this->product->orderBy('created_at','desc')->paginate(10);
        return view('lito-product::index',['data'=>$data]);
    }

    public function getCreate(){
        $category = $this->cate->scopeQuery(function($e){
            return $e->orderBy('created_at','desc')->where('parent',0);
        })->all();

        return view('lito-product::create',
            [
                'category' => $category
            ]
            );
    }

    public function postCreate(ProductValidate $request){
        $input = $request->except(['_token']);
        //dd($request->category);
        $seosetting = [
            'seo_title' => $request->seo_title,
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'facebook_title' => $request->facebook_title,
            'facebook_description' => $request->facebook_description,
            'facebook_image' => $request->facebook_image,
            'index_link' => $request->index_link,
            'follow_link' => $request->follow_link,
            'breadcrumb_title' => $request->breadcrumb_title,
            'canonical_url' => $request->canonical_url
        ];


        try{
           $productCreate = $this->product->create($input);
            if(!empty($request->category)){
                $category = $request->category;
                $this->product->sync($productCreate->id,'category',$category);
            }

            foreach($seosetting as $key => $val){
                ProductMeta::create(['product_id'=>$productCreate->id,'meta_key'=>$key,'meta_value'=>$val]);
            }

            return redirect()->route('lito::product.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id,Request $request){
        $data = $this->product->find($id);

        $category = $this->cate->scopeQuery(function ($e) {
            return $e->orderBy('created_at','desc')->select('id','name','parent','slug')->where('parent',0)
                ->get();
        })->all();
        //category selected
        $cateSelected = $data->category()->get();
        $selected = [];
        foreach ($cateSelected as $c){
            $selected[] = $c->id;
        }

        return view('lito-product::edit',[
            'data' => $data,
            'category' => $category,
            'selected' => $selected
        ]);
    }

    public function postEdit($id, ProductValidate $request){

        $input = $request->except(['_token']);

        $seosetting = [
            'seo_title' => $request->seo_title,
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            'facebook_title' => $request->facebook_title,
            'facebook_description' => $request->facebook_description,
            'facebook_image' => $request->facebook_image,
            'index_link' => $request->index_link,
            'follow_link' => $request->follow_link,
            'breadcrumb_title' => $request->breadcrumb_title,
            'canonical_url' => $request->canonical_url
        ];

        try{
            $this->product->update($input, $id);
            if(!empty($request->category)){
                $category = $request->category;
                $this->product->sync($id,'category',$category);
            }
            //update bảng productmeta
            $this->meta->getUpdateMeta($id,$seosetting);

            return redirect()->route('lito::product.index.get')->with(FlashMessage::returnMessage('edit'));

        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getDelete($id){
        try{
            $this->product->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}