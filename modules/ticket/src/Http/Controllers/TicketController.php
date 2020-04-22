<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 1:28 PM
 */

namespace Ticket\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Ticket\Http\Requests\TicketValidate;
use Ticket\Repositories\TicketRepository;
use Users\Repositories\UsersRepository;

class TicketController extends BaseController
{
    protected $tic;
    protected $us;
    public function __construct(TicketRepository $ticketRepository, UsersRepository $userRepository)
    {
        $this->tic = $ticketRepository;
        $this->us = $userRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex(Request $request)
    {
        $response = Curl::to('http://lito.test/v1/ticket/get-ticket?domain='.base_url())
            ->get();
        $response = json_decode($response);
        $type = $request->get('type');

        return view('lito-ticket::index', [
            'response' => $response,
            'type' => $type
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCreate(Request $request)
    {
        $type = $request->type;
        return view('lito-ticket::create', ['type'=>$type]);

    }

    /**
     * @param TicketValidate $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreate(TicketValidate $request)
    {
        $input = $request->except('_token');
        $title = $request->title;
        try{
            $response = Curl::to('http://lito.test/v1/ticket/put-create-ticket')
                ->withData($input)
                ->put();
            do_action('lito_before_create_ticket',$title,'Thêm mới','Ticket');
            return redirect()->route('lito::ticket.index.get')->with(FlashMessage::returnMessage('create'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEdit($id, Request $request)
    {
        $type = $request->type;
        $data = $this->tic->find($id);
        $user = $this->us->find($data->owner);
        $reply = $this->tic->orderBy('created_at','asc')->findWhere(['parent'=>$data->id]);
        $input = ['admin_status'=>'active'];
        $ids = [];
        $ids[].= $id;

        return view('lito-ticket::view', [
            'data' => $data,
            'user' => $user,
            'reply' => $reply,
            'type' => $type
        ]);
    }

    /**
     * @param TicketValidate $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(Request $request)
    {
        $input = [
            'domain' => $request->get('domain'),
            'owner' => $request->get('owner'),
            'parent' => $request->get('parent'),
            'content' => $request->get('content'),
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'type' => $request->get('type')
        ];

        try {

            $edit = $this->tic->create($input);

            do_action('lito_before_edit_ticket',$edit->name,'Trả lời','Ticket');

            return redirect()->back()->with(FlashMessage::returnMessage('edit'));

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(config('messages.error'));
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDelete($id)
    {
        $olditem = $this->tic->find($id);
        do_action('lito_before_delete_ticket',$olditem->name,'Xóa','Ticket');

        return getDelete($id, $this->tic);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function getStatus(Request $request)
    {
        $status = $request->get('status');
        $id = $request->get('id');

        if ($status == 'active') {
            $this->tic->update([
                'status' => 'disable'
            ], $id);
        }

        if ($status == 'disable') {
            $this->tic->update([
                'status' => 'active'
            ], $id);
        }

        do_action('lito_before_edit_ticket','Trạng thái','Sửa','Ticket');

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }
}