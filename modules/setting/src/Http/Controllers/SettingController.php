<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/14/2019
 * Time: 4:27 PM
 */

namespace Setting\Http\Controllers;

use Barryvdh\Debugbar\Controllers\BaseController;
use Base\Supports\FlashMessage;
use Illuminate\Http\Request;
use Mail\Repositories\MailRepository;
use Setting\Repositories\SettingRepositories;

class SettingController extends BaseController
{
    protected $set;
    protected $mail;

    public function __construct(SettingRepositories $settingRepositories, MailRepository $mailRepository)
    {
        $this->set = $settingRepositories;
        $this->mail = $mailRepository;
    }

    /**
     * @param $data
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function saveSetting($data)
    {
        foreach ($data as $key => $d) {
            $this->set->updateOrCreate([
                'setting_key' => $key
            ], [
                'setting_value' => $d
            ]);
        }

    }

    public function getSite()
    {
        return view('lito-setting::site');
    }

    public function getSetting()
    {
        return view('lito-setting::index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSetting(Request $request)
    {
        $data = $request->except('_token');

        try{
            $this->saveSetting($data);
            do_action('lito_before_edit_setting','Tất cả cấu hình','Sửa','Cấu hình');
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with(FlashMessage::returnMessage('edit'));
    }

    public function testEmail(Request $request){
        $email = $request->get('email_system_test');
        try{
            $this->mail->sendMail('test',$email,['data'=>'']);
            return redirect()->back()->with(FlashMessage::returnMessage('edit'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

}