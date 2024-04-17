<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title'                 => 'required|string',
            'title_en'              => 'required|string',
            'photo'                 => 'required|image|mimes:png,jpg,jpeg,svg',
            'description'           => 'required|string',
            'description_en'        => 'required|string',
            'meta_description'      => 'required|string|max:100',
            'meta_description_en'   => 'required|string|max:100',
            'price'                 => 'required|numeric',
            'offers'                => 'nullable|numeric',
            'quantity'              => 'required|string|integer',
            'country_id'            => 'required',
            'category_id'           => 'required',
            'sub_category_id'       => 'required',
            'measuring_unit_id'     => 'required',
            'user_id'               => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'title_en'          => 'title English',
            'description_en'    => 'description English',
            'country_id'        =>  'country',
            'category_id'       =>  'category',
            'sub_category_id'   =>  'sub category',
            'measuring_unit_id' =>  'measuring unit',
            'user_id'           =>  'importers',
        ];
    }
}
