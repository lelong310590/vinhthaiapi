<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/5/2019
 * Time: 3:13 PM
 */

namespace Ticket\Hook;

use Ticket\Models\Ticket;

class TicketNotificationHook
{
    public function handle()
    {
        try{
            $ticket = Ticket::where(['domain'=>website_url(),'admin_status'=>'disable','type'=>'guest'])->count();
        }catch (\Exception $e){
            $ticket = 0;
        }

        echo view('lito-ticket::partials.notification-ticket',[
            'ticketnumber'=>$ticket
        ]);
    }
}