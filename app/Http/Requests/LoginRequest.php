<?php

namespace App\Http\Requests;

use App\Http\Traits\HttpResponse;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function failedValidation(ValidationValidator $validator)
    {
        HttpResponse::error('Erreur de validation! Vérifiez vos identifiants', $validator->errors());
    }
}