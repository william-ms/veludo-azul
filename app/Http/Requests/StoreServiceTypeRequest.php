<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceTypeRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:service_types'],
            'value' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name' => [
                'unique' => 'Já existe um tipo de serviço cadastrado com esse nome',
            ]
        ];
    }
}
