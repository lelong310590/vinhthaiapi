<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/22/2019
 * Time: 1:28 PM
 */

namespace Contact\Hook;


use Contact\Models\Contact;

class ContactWidgetHook
{
    public function handle(){
        $contact = Contact::all()->count();
        echo view('lito-contact::partials.widget-contact',
            [
                'contactnum' => $contact
            ]);
    }
}