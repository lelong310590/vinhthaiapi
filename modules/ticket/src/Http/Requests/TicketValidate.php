<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 4/1/2019
 * Time: 1:31 PM
 */

namespace Ticket\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TicketValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
        ];
    }

    /***
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => 'Tiêu đề không được bỏ trống',
        ];
    }
}