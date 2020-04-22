<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:24 PM
 */

namespace TicketAdmin\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail\Repositories\MailRepository;
use Ticket\Repositories\TicketRepository;

class TicketAdminController extends BaseController
{
    protected $tic;
    protected $mail;

    public function __construct(TicketRepository $ticketRepository, MailRepository $mailRepository)
    {
        $this->tic = $ticketRepository;
        $this->mail = $mailRepository;
    }

    public function getIndex(Request $request){
        $status = $request->get('status');
        if($request->get('status')){
            $data = $this->tic->scopeQuery(function ($e) use ($status){
                return $e->orderBy('created_at','desc')->where(['status'=>$status,'parent'=>0]);
            })->paginate(20);
        }else{
            $data = $this->tic->scopeQuery(function ($e){
                return $e->orderBy('created_at','desc')->where('parent',0);
            })->paginate(20);
        }

        return view('lito-ticket-admin::index',['data'=>$data]);
    }

    public function getEdit($id){
        $data = $this->tic->find($id);
        $reply = $this->tic->findWhere(['parent'=>$data->id]);
        return view('lito-ticket-admin::view',['data'=>$data,'reply'=>$reply]);
    }

    public function postEdit($id,Request $request)
    {
        $input = [
          'parent' => $request->get('parent'),
          'domain' => $request->get('domain'),
          'owner' => $request->get('owner'),
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'type' => $request->get('type'),
          'support_name' => $request->get('support_name'),
          'content' => $request->get('content'),
          'status' => $request->get('status')
        ];
        try{
            $create = $this->tic->create($input);
            if($request->get('status')){
                $data = [
                  'status' => $request->get('status')
                ];
                $this->tic->update($data,$id);

            }
            $mailto = $request->get('mailto');
            $this->mail->sendMail('ticket',$mailto,['content'=>$create->content]);
            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

}