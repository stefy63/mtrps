<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:8',             // Deve essere di almeno 8 caratteri
                'regex:/[a-z]/',      // Deve contenere almeno una lettera minuscola
                'regex:/[A-Z]/',      // Deve contenere almeno una lettera maiuscola
                'regex:/[0-9]/',      // Deve contenere almeno un numero
                'regex:/[@$!%*#?&]/', // Deve contenere almeno un carattere speciale
            ]
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'email.required' => 'La email è obbligatoria',
            'email.unique' => 'La email è già in uso',
            'password.required' => 'La password è obbligatoria',
            'password.confirmed' => 'La conferma della password non corrisponde',
            'password.min' => 'La password deve essere di almeno 8 caratteri',
            'password.regex' => 'La password deve contenere almeno una lettera minuscola, una lettera maiuscola, un numero e un carattere speciale (@$!%*#?&)'
        ];
    }
}
