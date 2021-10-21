<?php

namespace Viropanel\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Illuminate\Http\Response;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return Gate::allows('category_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'required|integer',
            'ordering' => 'required|integer',
            'name' => 'required|max:255',
            'icon' => 'max:50',
            'content' => 'max:255',
            'title' => 'max:255',
            'keywords' => 'max:255',
            'description' => 'max:255',
        ];
    }
}
