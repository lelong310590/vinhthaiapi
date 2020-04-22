<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 11:44 AM
 */

namespace Ticket\Hook;


class TicketHook
{
    public function handle()
    {
        echo view('lito-ticket::partials.sidebar');
    }
}