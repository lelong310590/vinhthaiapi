<?php
/**
 * Created by PhpStorm.
 * User: dell-annt
 * Date: 3/12/2019
 * Time: 11:53 AM
 */

namespace Taxonomy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxonomyValidate extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được bỏ trống',
            'slug.required' => 'Chưa có đường dẫn tĩnh'
        ];
    }
}