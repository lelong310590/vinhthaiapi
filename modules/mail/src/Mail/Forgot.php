<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 11:13 AM
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Forgot extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build(){
        $data = $this->data;
        return $this->from('noreply@lito.vn')
            ->view('lito-mail::templates.forgot')
            ->subject('Lấy lại mật khẩu')->with(['email'=>$data['email'],'token'=>$data['token']]);
    }

}