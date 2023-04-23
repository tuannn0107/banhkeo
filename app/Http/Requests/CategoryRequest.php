<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_id' => $this->category_id ?? $this->master_id,
        ]);

        if (collect(Category::OTHER)->contains(str($this->master)->after('-'))) {
            if (!$this->name) {
                $this->merge([
                    'name' => 'empty_' . str(str()->random(10))->slug()
                ]);
            }

            if (!$this->slug) {
                $this->merge([
                    'slug' => 'empty_' . str(str()->random(10))->slug()
                ]);
            }
        } else {
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
            'name' => ['required', 'unique:categories,name,' . $this->id, 'unique:categories,slug,' . $this->id],
        ];
    }

    public function messages()
    {
        $path = collect(Category::OTHER)->contains($this->master) ? $this->master : 'category';
        return [
            'name.unique' => trans('validation.custom.' . $path . '.name'),
        ];
    }
}
