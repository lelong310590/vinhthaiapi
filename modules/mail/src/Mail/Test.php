<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:50 AM
 */

namespace Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Test extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {

    }

    public function build()
    {
        return $this->from('noreply@lito.vn')
            ->view('lito-mail::templates.test')
            ->subject('Test mail');
    }

}