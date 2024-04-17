<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            'name'          => 'required|string',
            'email'         => 'required|email',
            'password'      => 'required|password|confirmed',
            'phone'         => 'required|numeric',
            'country_id'    => 'required',
            'state_id'      => 'required',
            'city_id'       => 'required',
            'address'       => 'required',
            'type_account'  => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'country_id'    => 'Country',
            'state_id'      => 'state',
            'city_id'       => 'city',
            'type_account'  => 'type account',
        ];
    }
}
