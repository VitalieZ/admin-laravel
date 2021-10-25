<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('post_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer',
            'name' => 'required|max:255',
            'name_en' => 'required|max:255',
            'content' => 'required',
            'image' => 'file|mimes:png,jpg,jpeg|max:2048',
            'file_url' => 'file|mimes:zip',
            'extern_url' => 'max:255',
        ];
    }
}
