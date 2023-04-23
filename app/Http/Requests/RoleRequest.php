<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => ['required', 'unique:roles,name,' . $this->id, 'unique:roles,slug,' . $this->id],
            'permissionList.*' => ['numeric']
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.custom.role.name'),
        ];
    }
}
