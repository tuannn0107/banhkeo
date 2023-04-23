<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'is_active' => $this->has('is_active') ? 1 : 0
        ]);

        if (!$this->title) {
            $this->merge([
                'slug' => str($this->name)->slug()
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:posts,name,' . $this->id, 'unique:posts,slug,' . $this->id],
            'price' => 'required_with:sale_price',
            'sale_price' => 'nullable|lt:price',
            'slug' => ['required', 'unique:seos,canonical,' . $this->seo_id]
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('validation.custom.post.name'),
            'slug.unique' => trans('validation.custom.seo.slug'),
        ];
    }
}
