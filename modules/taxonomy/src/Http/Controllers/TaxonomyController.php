<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/5/2019
 * Time: 4:12 PM
 */

namespace Taxonomy\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Taxonomy\Http\Requests\TaxonomyValidate;
use Taxonomy\Repositories\TaxonomyMetaRepository;
use Taxonomy\Repositories\TaxonomyRepositories;

class TaxonomyController extends BaseController
{
    protected $ta;
    protected $meta;

    /**
     * TaxonomyController constructor.
     * @param TaxonomyRepositories $taxonomyRepositories
     */
    public function __construct(TaxonomyRepositories $taxonomyRepositories, TaxonomyMetaRepository $taxonomyMetaRepository)
    {
        $this->ta = $taxonomyRepositories;
        $this->meta = $taxonomyMetaRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {

        $data = $this->ta->scopeQuery(function ($e) use($request){
           return $e->orderBy('created_at','desc')->select('id','name','taxonomy_type','index','status')
               ->where('taxonomy_type',$request->type);
        })->paginate(20);
        return view('lito-taxonomy::index', ['data'=> $data,'type'=>$request->type]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(Request $request)
    {
        $type = $request->type;
        $data = $this->ta->scopeQuery(function ($e) use($type){
            return $e->orderBy('id','desc')->select('id','name','parent','slug')
                ->where('taxonomy_type',$type)->get();
        })->all();
        return view('lito-taxonomy::create',['data'=>$data,'type'=>$type]);
    }

    /**
     * @param TaxonomyValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(TaxonomyValidate $request)
    {
        $input = $request->except(['_token']);
        $slug = $request->get('slug');
        $old = $this->ta->findWhere(['slug'=>$slug]);
        if(!empty($old) && count($old)>0){
            return redirect()->back()->with(['message'=>'Tiêu đề danh mục đã tồn tại ! Vui lòng nhập tên khác']);
        }
        try{

            $create = $this->ta->create($input);
            do_action('lito_before_create_taxonomy',$create->name,'Thêm mới','Danh mục');
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
            foreach($seosetting as $key => $val){
                $this->meta->create(['taxonomy_id'=>$create->id,'meta_key'=>$key,'meta_value'=>$val]);
            }

            if ($request->has('continue_edit')) {
                return redirect()->route('lito::taxonomy.create.get',['type'=> $create->taxonomy_type])->with(FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::taxonomy.index.get',['type'=> $create->taxonomy_type])->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id)
    {
        $data = $this->ta->find($id);
        $type = $data->taxonomy_type;
        $all = $this->ta->scopeQuery(function ($e) use($type){
            return $e->orderBy('id','desc')->select('id','name','parent','slug')
                ->where('taxonomy_type',$type)->get();
        })->all();

        return view('lito-taxonomy::edit',[
            'data'=>$data,'all'=>$all
        ]);
    }

    /**
     * @param $id
     * @param TaxonomyValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, TaxonomyValidate $request){
        $input = $request->except(['_token']);
        try {
           $edit = $this->ta->update($input, $id);
            do_action('lito_before_edit_taxonomy',$edit->name,'Sửa','Danh mục');
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

            $this->meta->getUpdateTaxoMeta($id,$seosetting);

            return redirect()->route('lito::taxonomy.index.get',['type'=>$edit->taxonomy_type])->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id){
        $olditem = $this->ta->find($id);
        try{
            do_action('lito_before_delete_taxonomy',$olditem->name,'Xóa','Danh mục');
            $this->ta->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->ta->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->ta->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }


}