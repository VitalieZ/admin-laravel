<?php

namespace Viropanel\Admin\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;


class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('category_edit');
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
            'name' => 'required|min:4|max:50',
            'name_ru' => 'exclude_unless:name_ru,null|min:4|max:50|nullable',
            'name_ro' => 'exclude_unless:name_ro,null|min:4|max:50|nullable',
            'title' => 'max:255',
            'keywords' => 'max:255',
            'description' => 'max:255',
            'visible' => '',
        ];
    }
}
