<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 8/2/2018
 * Time: 3:29 PM
 */

namespace Faqs\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqsValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "FAQs group 's title is not empty",
            'name.min' => "FAQs group 's title minimum of 3 characters"
        ];
    }
}