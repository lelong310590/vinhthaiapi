<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/3/2019
 * Time: 10:55 AM
 */

namespace Mail\Repositories;

use Mail\Mail\Ticket_send;
use Mail\Models\Mail as MailModel;
use Mail\Mail\Test;
use Mail\Mail\Forgot;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Mail;

class MailRepository extends BaseRepository
{
    protected $adminMail;

    protected $custommerMail;

    public function model()
    {
        // TODO: Implement model() method.
        return MailModel::class;
    }

    /**
     * @param $type
     * @param $content
     */
    public function writeToBlade($type, $content)
    {
        $path = view('lito-mail::templates.'.$type)->getPath();
        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $content);
        fclose($myfile);
    }

    /**
     * @param $temp
     * @param $target
     * @param $data
     */
    public function sendMail($temp, $target, $data)
    {
        switch ($temp) {
            case 'forgot_pass':
                Mail::to($target)->send(new Forgot($data));
                break;
            case 'ticket' :
                Mail::to($target)->send(new Ticket_send($data));
                break;
            default:
                Mail::to($target)->send(new Test());
        }
    }
}