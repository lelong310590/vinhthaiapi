<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:36 AM
 */

namespace Ticket\Http\Controllers;


use Barryvdh\Debugbar\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mail\Repositories\MailRepository;
use Ticket\Repositories\TicketRepository;

class ApiTicketController extends BaseController
{
    protected $tic;
    protected $mail;

    public function __construct(TicketRepository $ticketRepository, MailRepository $mailRepository)
    {
        $this->tic = $ticketRepository;
        $this->mail = $mailRepository;
    }

    public function getCreateTicket(Request $request){
        try{
            $this->tic->create($request->all());
            $email = $request->get('email');
            //$this->mail->sendMail('ticket',$email,['content'=>$content]);
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }

    }

    public function getTicket(Request $request){
        $domain = $request->get('domain');
        try{
            $ticket = $this->tic->scopeQuery(function ($e) use($domain){
                return $e->orderBy('created_at','desc')->select('id','parent','domain','name','email','title','content','created_at','updated_at','type','status','support_name')->where(['parent'=>0,'domain'=>$domain]);
            })->paginate(20);
            return $ticket;
        }catch (\Exception $e){
            return response()->json(['message' => config('messages.error')])->setStatusCode(500);
        }

    }

}