<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/5/2019
 * Time: 2:38 PM
 */

namespace Contact\Hook;
use Contact\Models\Contact;

class ContactNotificationHook
{
    public function handle(){

        $contact = Contact::where(['status'=>'disable'])->count();
        $last_contact = Contact::orderBy('created_at','desc')->first();

        echo view('lito-contact::partials.notification-contact', [
            'contactnotread' => $contact,
            'lastcontact' => $last_contact
        ]);
    }
}