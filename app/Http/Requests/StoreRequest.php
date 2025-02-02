<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
    public function rules() : array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'
                , 'unique:stores,name'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name of store is required.',
            'name.string' => 'The name of the store must be a string.',
            'name.regex' => 'The subdomain name must be valid (The name can only contain miniscule letters, numbers and dashes (e.g. my-shop).',
            'name.unique' => 'This is already taken.',
        ];
    }
}
