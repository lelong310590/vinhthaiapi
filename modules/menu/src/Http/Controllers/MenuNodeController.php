<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 4:15 PM
 */

namespace Menu\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Menu\Http\Requests\MenuNodeValidate;
use Menu\Repositories\MenuNodeRepositories;
use Post\Repositories\PostRepositories;
use Taxonomy\Repositories\TaxonomyRepositories;

class MenuNodeController extends BaseController
{
    protected $node;
    protected $tax;
    protected $po;

    /**
     * MenuNodeController constructor.
     * @param MenuNodeRepositories $menuNodeRepositories
     * @param TaxonomyRepositories $taxonomyRepositories
     */
    public function __construct(MenuNodeRepositories $menuNodeRepositories, TaxonomyRepositories $taxonomyRepositories, PostRepositories $postRepositories)
    {
        $this->node = $menuNodeRepositories;
        $this->tax = $taxonomyRepositories;
        $this->po = $postRepositories;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $menu_id = $request->get('menu_id');
        $data = $this->node->getMenuNode($menu_id);
        return view('lito-menu::menunode.index', ['data'=>$data,'menu_id'=>$menu_id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(Request $request)
    {

        $menu_id = $request->get('menu_id');

        $data = $this->node->getMenuNode($menu_id);

        $taxonomy = $this->tax->scopeQuery(function ($e) {
           return $e->orderBy('created_at','desc')->select('id','name','slug')->where('status','active')
               ->where('taxonomy_type','category');
        })->all();
        $page = $this->po->scopeQuery(function ($e){
           return $e->orderBy('created_at','desc')->select('id','post_title','post_slug','post_type','post_status')
                    ->where(['post_status'=>'publish','post_type'=>'page'])->get();
        })->all();
        return view('lito-menu::menunode.create', ['data'=>$data,'taxonomy'=>$taxonomy,'menu_id'=>$menu_id,'page'=>$page]);
    }

    /**
     * @param MenuNodeValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(MenuNodeValidate $request)
    {
        $input = $request->except(['_token']);
        try{
            $create = $this->node->create($input);
            do_action('lito_before_create_menu',$create->name,'Thêm mới','Menu');
            return redirect()->back()->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id, Request $request)
    {
        $menu_id = $request->get('menu_id');
        $data = $this->node->find($id);

        $all = $this->node->scopeQuery(function ($e) use($menu_id) {
           return $e->orderBy('created_at','desc')->select('id','name','parent')
                    ->where('menu_id',$menu_id);
        })->all();

        $taxonomy = $this->tax->scopeQuery(function ($e) {
            return $e->orderBy('created_at','desc')->select('id','name','slug')->where('taxonomy_type','category');
        })->all();

        $page = $this->po->scopeQuery(function ($e){
            return $e->orderBy('created_at','desc')->select('id','post_title','post_slug','post_type','post_status')
                ->where(['post_status'=>'publish','post_type'=>'page'])->get();
        })->all();

        return view('lito-menu::menunode.edit',[
            'data'=>$data,'all'=>$all,
            'taxonomy'=>$taxonomy,
            'menu_id'=>$menu_id,
            'page' => $page
        ]);
    }

    /**
     * @param $id
     * @param MenuNodeValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, MenuNodeValidate $request)
    {
        $input = $request->except(['_token']);
        try {
           $edit = $this->node->update($input, $id);
            do_action('lito_before_edit_menu',$edit->name,'Sửa','Menu');
            return redirect()->route('lito::node.create.get',[
                'menu_id'=>$edit->menu_id
            ])->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id){
        $menu = $this->node->find($id);
        try{
            do_action('lito_before_delete_menu',$menu->name,'Xóa','Menu');
            $this->node->delete($id);
            return redirect()->route('lito::node.create.get',[
                'menu_id'=>$menu->menu_id
            ])->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->node->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->node->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}