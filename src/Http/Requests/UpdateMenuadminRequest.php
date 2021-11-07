<?php

namespace Viropanel\Admin\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;


class UpdateMenuadminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('menu_admin_edit');
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
            'icon' => 'max:50',
            'uri' => 'max:50',
            'title' => 'max:255',
            'permission' => 'required|max:255',
            'visible' => '',
        ];
    }
}
