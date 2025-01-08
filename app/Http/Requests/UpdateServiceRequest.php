<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'client_id' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'service_items' => ['required', 'array'],
            'value' => ['required', 'string'],
            'delivery_date' => ['required', 'date'],
            'status' => ['required', 'integer']
        ];
    }
}
