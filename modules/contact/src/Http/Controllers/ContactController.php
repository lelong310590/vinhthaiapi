<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/21/2019
 * Time: 5:25 PM
 */

namespace Contact\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Contact\Models\Answers;
use Contact\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    protected $con;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->con = $contactRepository;
    }

    public function getIndex(){
        $data = $this->con->orderBy('created_at','desc')->paginate(20);
        return view('lito-contact::index',['data'=>$data]);
    }

    public function getDetail($id){
        $data = $this->con->with('getAnswer')->find($id);
        try{
            if($data->status=='disable'){
                $edit = $this->con->update(['status'=>'active'],$id);
            }
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
        return view('lito-contact::detail',['data'=>$data]);
    }

    public function getDelete($id){
        $this->con->find($id);
        try{
            $this->con->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function postAnswer(Request $request){
        try{
            $check = Answers::where('contact_id',$request->contact_id)->first();
            if($check){
                $check->content = $request->contentt;
                $check->save();
            }else{
                $answerModel = new Answers();
                $answerModel->contact_id = $request->contact_id;
                $answerModel->content = $request->contentt;
                $answerModel->save();
            }

            return redirect()->back();
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}