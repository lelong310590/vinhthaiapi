<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 1:29 PM
 */

namespace Ticket\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;
use Ticket\Models\Ticket;

class TicketRepository extends BaseRepository
{
    public function model()
    {
       return Ticket::class;
    }

    public function TicketNotification(){
        $ticket = $this->scopeQuery(function ($e){
           return $e->orderBy('created_at','desc')->select('id','parent','domain','email','content','created_at','status')
               ->where(['domain'=>base_url(),'type'=>'guest','status'=>'read'])->take(5);
        })->all();
        return $ticket;
    }

}