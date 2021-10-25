<?php

namespace Viropanel\Admin\Http\Requests;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;


class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('permission_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
