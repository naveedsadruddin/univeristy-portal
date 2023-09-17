<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEdit extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [ auth()->user()->hasRole('admin') ? 'required' : 'nullable', 'email', 'unique:users,email,'.$this->user ],
            'password' => 'nullable|min:6',
            'roles' => [auth()->user()->isAdmin() ? 'required' : 'nullable', 'array'],
            'roles.*' => 'exists:roles,id',
            'status' => 'required',
        ];
    }
}
