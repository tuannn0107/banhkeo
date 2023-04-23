<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'bail|required|password',
            'new_password' => 'required|string|min:8',
            'new_password_confirmation' => 'same:new_password'
        ];
    }

    public function messages()
    {
        return [
            'current_password.password' => trans('validation.current_password'),
        ];
    }
}
