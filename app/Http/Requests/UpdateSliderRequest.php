<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'             => 'required|string',
            'title_en'          => 'required|string',
            'photo'             => 'nullable|image|mimes:png,jpg,jpeg,svg',
            'description'       => 'required|string',
            'description_en'    => 'required|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'title_en'          => 'title English',
            'description_en'    => 'description English'
        ];
    }
}
