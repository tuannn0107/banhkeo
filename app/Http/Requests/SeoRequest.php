<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoRequest extends FormRequest
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
            'canonical' => $this->slug,
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
            'slug' => ['required', 'unique:seos,canonical,' . $this->seo_id]
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => trans('validation.custom.seo.slug'),
        ];
    }
}
