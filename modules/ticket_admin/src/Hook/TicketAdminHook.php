<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/2/2019
 * Time: 10:02 PM
 */
namespace TicketAdmin\Hook;

use Ticket\Models\Ticket;

class TicketAdminHook
{

    public function handle()
    {
        $read = Ticket::where(['status'=>'read','parent'=>0])->where(['status'=>'read','parent'=>0])->count();
        $unread = Ticket::where(['status'=>'unread','parent'=>0])->where(['status'=>'unread','parent'=>0])->count();
        $resolve = Ticket::where(['status'=>'resolve','parent'=>0])->where(['status'=>'resolve','parent'=>0])->count();
        echo view('lito-ticket-admin::partials.sidebar',['readnum'=>$read,'unreadnum'=>$unread,'resolvenum'=>$resolve]);
    }
}