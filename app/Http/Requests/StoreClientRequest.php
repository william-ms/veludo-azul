<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreClientRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^\(\d{2}\)\s\d{5}-\d{4}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone' => [
                'regex' => 'O formato do telefone é inválido',
            ]
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                
                $data = $validator->getData();

                if(Client::where('phone', preg_replace('/[^0-9]/', '', $data['phone']))->first()) {
                    $validator->errors()->add(
                        'phone',
                        'Já existe um cliente cadastrado com esse número de telefone'
                    );
                }
            }
        ];
    }
}
