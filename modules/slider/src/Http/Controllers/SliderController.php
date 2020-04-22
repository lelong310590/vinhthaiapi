<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 2:50 PM
 */

namespace Slider\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Slider\Http\Requests\SliderValidate;
use Slider\Reposotories\SliderRepository;

class SliderController extends BaseController
{
    protected $sl;

    public function __construct(SliderRepository $sliderRepository)
    {
        $this->sl = $sliderRepository;
    }

    public function getIndex(Request $request){
        $groupid = $request->groupid;
        $data = $this->sl->scopeQuery(function ($e) use($groupid){
           return $e->orderBy('id','desc')->select('id','name','type','thumbnail','index','status')
               ->where('group_id',$groupid);
        })->paginate(20);
        return view('lito-slider::items.index',['data'=>$data,'groupid'=>$groupid]);
    }

    public function getCreate(Request $request){
        $groupid = $request->groupid;
        return view('lito-slider::items.create',['groupid'=>$groupid]);
    }

    public function postCreate(SliderValidate $request){
        $input = $request->except(['_token']);
        $groupid = $request->groupid;
        try{
            $create = $this->sl->create($input);
            do_action('lito_before_create_slider',$create->name,'Thêm mới','Slider');
            if ($request->has('continue_edit')) {
                return redirect()->route('lito::slider.create.get',['groupid'=>$groupid])->with(FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::slider.index.get',['groupid'=>$groupid])->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id,Request $request){
        $data = $this->sl->find($id);
        return view('lito-slider::items.edit', ['data'=>$data]);
    }

    public function postEdit($id, SliderValidate $request){
        $input = $request->except(['_token']);
        $groupid = $request->groupid;
        try{
           $edit = $this->sl->update($input,$id);
            do_action('lito_before_edit_slider',$edit->name,'Sửa','Slider');
            return redirect()->route('lito::slider.index.get',['groupid'=>$groupid])->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    public function getDelete($id){
        $olditem = $this->sl->find($id);
        try{
            do_action('lito_before_delete_slider',$olditem->name,'Xóa','Slider');
            $this->sl->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->sl->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->sl->update([
                'status' => 'active'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}