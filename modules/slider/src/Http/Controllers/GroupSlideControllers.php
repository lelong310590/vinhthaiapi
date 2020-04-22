<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/23/2019
 * Time: 11:27 AM
 */

namespace Slider\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Slider\Http\Requests\GroupSlideValidate;
use Slider\Repositories\GroupSlideRepository;

class GroupSlideControllers extends BaseController
{
    protected $gr;

    public function __construct(GroupSlideRepository $groupSlideRepository)
    {
        $this->gr = $groupSlideRepository;
    }

    public function getList(){
        $data = $this->gr->orderBy('id','desc')->paginate(10);
        return view('lito-slider::list',['data'=>$data]);
    }

    public function getCreate(){
        return view('lito-slider::create');
    }

    public function postCreate(GroupSlideValidate $request){
        $input = $request->except(['_token']);
        try{
           $create = $this->gr->create($input);
            do_action('lito_before_create_slider',$create->name,'Thêm mới','Loại Slider');
            if ($request->has('continue_edit')) {
                return redirect()->route('lito::group.create.get')->with(FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::group.list.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id){
        $data = $this->gr->find($id);
        return view('lito-slider::edit',['data'=>$data]);
    }

    public function postEdit($id, GroupSlideValidate $request){
        $input = $request->except(['_token']);
        try{
            $edit = $this->gr->update($input,$id);
            do_action('lito_before_edit_slider',$edit->name,'Sửa','Loại Slider');
            return redirect()->route('lito::group.list.get')->with(FlashMessage::returnMessage('create'));
        }
        catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getDelete($id){
        $olditem = $this->gr->find($id);
        try{
            do_action('lito_before_delete_slider',$olditem->name,'Xóa','Loại Slider');
            $this->gr->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->gr->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->gr->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}