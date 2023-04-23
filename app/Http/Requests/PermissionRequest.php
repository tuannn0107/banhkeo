<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
     * Prepare for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => str($this->name)->slug(),
            'is_active' => $this->has('is_active') ? 1 : 0
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:permissions,name,' . $this->id, 'unique:permissions,slug,' . $this->id],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.custom.permission.name'),
        ];
    }
}
