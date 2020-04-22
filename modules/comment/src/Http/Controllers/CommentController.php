<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/25/2019
 * Time: 3:43 PM
 */

namespace Comment\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Comment\Http\Requests\CommentValidate;
use Comment\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends BaseController
{
    protected $cm;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->cm = $commentRepository;
    }

    public function getIndex(){
        $data = $this->cm->scopeQuery(function ($e) {
            return $e->orderBy('id','desc')->select('id','post_id','name','email','thumbnail','comment_content','parent','approved');
        })->paginate(20);
        return view('lito-comment::index',['data'=>$data]);
    }

    public function getCreate(){
        return view('lito-comment::create');
    }

    public function postCreate(CommentValidate $request){
        $input = $request->except(['_token']);
        try{
            $this->cm->create($input);
            if ($request->has('continue_edit')) {
                return redirect()->route('lito::comment.create.get')->with(FlashMessage::returnMessage('create'));
            }
            return redirect()->route('lito::comment.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getEdit($id){
        $data = $this->cm->find($id);
        return view('lito-comment::edit',['data'=>$data]);
    }

    public function postEdit($id, CommentValidate $request){
        $input = $request->except(['_token']);
        try{
            $this->cm->update($input,$id);
            return redirect()->route('lito::comment.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getDelete($id){
        $this->cm->find($id);
        try{
            $this->cm->delete($id);
            return redirect()->back()->with(FlashMessage::returnMessage('delete'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getStatus(Request $request){
        $status = $request->get('approved');
        $id = $request->get('id');

        if ($status == 'accept') {
            $this->cm->update([
                'approved' => 'cancel'
            ], $id);
        }

        if ($status == 'cancel') {
            $this->cm->update([
                'approved' => 'accept'
            ], $id);
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

}