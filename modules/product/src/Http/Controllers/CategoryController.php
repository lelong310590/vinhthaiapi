<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/19/2019
 * Time: 10:35 PM
 */

namespace Product\Http\Controllers;


use Barryvdh\Debugbar\ServiceProvider;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Product\Http\Requests\CategoryValidate;
use Product\Repositories\CategoryMetaRepository;
use Product\Repositories\CategoryRepository;

class CategoryController extends ServiceProvider
{
    protected $cate;
    protected $meta;

    public function __construct(CategoryRepository $categoryRepository, CategoryMetaRepository $categoryMetaRepository)
    {
        $this->cate = $categoryRepository;
        $this->meta = $categoryMetaRepository;
    }

    public function getIndex(){
        $data = $this->cate->orderBy('id','desc')->paginate(20);
        return view('lito-product::category.index',['data'=>$data]);
    }

    public function getCreate(){
        $data = $this->cate->orderBy('id','desc')->all();
        return view('lito-product::category.create',['data'=>$data]);
    }

    public function postCreate(CategoryValidate $request){
        $input = $request->except(['_token']);
        try{
            $create = $this->cate->create($input);

            $seosetting = [
                'seo_title' => $request->seo_title,
                'seo_keyword' => $request->seo_keyword,
                'seo_description' => $request->seo_description,
                'facebook_title' => $request->facebook_title,
                'facebook_description' => $request->facebook_description,
                'facebook_image' => $request->facebook_image,
                'follow_link' => $request->follow_link,
                'breadcrumb_title' => $request->breadcrumb_title,
                'canonical_url' => $request->canonical_url
            ];
            foreach($seosetting as $key => $val){
                $this->meta->create(['category_id'=>$create->id,'meta_key'=>$key,'meta_value'=>$val]);
            }

            if ($request->has('continue_edit')) {
                return redirect()->route('lito::category.create.get')->with(FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::category.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id){
        $data = $this->cate->find($id);
        $all = $this->cate->orderBy('id','desc')->all();
        return view('lito-product::category.edit',['data'=>$data,'all'=>$all]);
    }

    public function postEdit($id,CategoryValidate $request){
        $input = $request->except(['_token']);
        try{
            $edit = $this->cate->update($input,$id);

            $seosetting = [
                'seo_title' => $request->seo_title,
                'seo_keyword' => $request->seo_keyword,
                'seo_description' => $request->seo_description,
                'facebook_title' => $request->facebook_title,
                'facebook_description' => $request->facebook_description,
                'facebook_image' => $request->facebook_image,
                'follow_link' => $request->follow_link,
                'breadcrumb_title' => $request->breadcrumb_title,
                'canonical_url' => $request->canonical_url
            ];

            $this->meta->getUpdateTaxoMeta($id,$seosetting);

            return redirect()->route('lito::category.index.get')->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getDelete($id){
        $this->cate->find($id);
        try{
            $this->cate->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->cate->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->cate->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}