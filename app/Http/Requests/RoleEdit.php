<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleEdit extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'permissions' => 'array',
            'permissions.*' => 'nullable',
            'slug' => 'required|unique:roles,slug,'.$this->role,
            'description' => 'nullable',
            'status' => 'required',
        ];
    }
}
