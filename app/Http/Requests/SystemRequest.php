<?php

namespace App\Http\Requests;

use App\Enums\SystemType;
use Illuminate\Foundation\Http\FormRequest;

class SystemRequest extends FormRequest
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
        $systemTypeArray = [];
        foreach (SystemType::cases() as $systemType) {
            $systemTypeArray = array_merge($systemTypeArray, [$systemType->value => $this->has($systemType->value) ? 1 : 0]);
        }

        $this->merge($systemTypeArray);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
