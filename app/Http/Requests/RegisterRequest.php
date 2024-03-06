<?php

namespace App\Http\Requests;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'unique:users,email'],
            'password' => ['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        HttpResponse::error('Erreur de validation', $validator->errors());
    }

    public function messages()
    {
        return [
            'email.unique' => 'Ce mail est déjà pris'
        ];
    }
}