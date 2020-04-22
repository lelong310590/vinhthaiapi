<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 12:05 PM
 */

namespace Mail\Mail;


use Illuminate\Mail\Mailable;

class Ticket_send extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(){
        $data = $this->data;
        return $this->from('noreply@lito.vn')
            ->view('lito-mail::templates.ticket')
            ->subject('Support Lito')->with(['content'=>$data['content']]);
    }
}