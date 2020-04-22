<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/11/2019
 * Time: 2:01 PM
 */

namespace Menu\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Menu\Http\Requests\MenuValidate;
use Menu\Repositories\MenuRepositories;

class MenuController extends BaseController
{
    protected $repository;

    /**
     * MenuController constructor.
     * @param MenuRepositories $menuRepositories
     */
    public function __construct(MenuRepositories $menuRepositories)
    {
        $this->repository = $menuRepositories;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $data = $this->repository->orderBy('id', 'desc')->paginate(20);
        return view('lito-menu::index', [
            'data'=>$data
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate()
    {
        return view('lito-menu::create');
    }

    /**
     * @param MenuValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(MenuValidate $request)
    {
        $input = $request->except(['_token']);

        try{
           $create = $this->repository->create($input);
            do_action('lito_before_create_menu',$create->name,'Thêm mới','Loại Menu');
            return redirect()->route('lito::menu.index.get')->with(FlashMessage::returnMessage('create'));
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
        $data = $this->repository->find($id);
        return view('lito-menu::edit',[
            'data'=>$data
        ]);
    }

    /**
     * @param $id
     * @param MenuValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit($id, MenuValidate $request)
    {
        $input = $request->except(['_token']);

        try {
           $edit = $this->repository->update($input, $id);
            do_action('lito_before_edit_menu',$edit->name,'Sửa','Loại Menu');
            return redirect()->route('lito::menu.index.get')->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getDelete($id)
    {
       $olditem = $this->repository->find($id);
        do_action('lito_before_delete_menu',$olditem->name,'Xóa','Loại Menu');
        try{
            $this->repository->delete($id);
            return redirect()->route('lito::menu.index.get')->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}