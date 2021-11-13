<?php

namespace Viropanel\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMenuadminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('menu_admin_create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            '*.parent_id' => 'required|integer',
            '*.name' => 'required|min:4|max:50',
            '*.name_ru' => 'min:4|max:50|nullable',
            '*.name_ro' => 'min:4|max:50|nullable',
            '*.icon' => 'max:50',
            '*.uri' => 'max:50',
            '*.permission' => 'required|max:255',
            '*.visible' => '',
        ];
    }
}
