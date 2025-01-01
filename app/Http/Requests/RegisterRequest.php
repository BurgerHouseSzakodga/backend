<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'A név megadása kötelező.',
            'name.string' => 'A név csak szöveget tartalmazhat.',
            'name.max' => 'A név nem lehet hosszabb, mint 10 karakter.',
            'email.required' => 'Az email cím megadása kötelező.',
            'email.string' => 'Az email cím csak szöveget tartalmazhat.',
            'email.email' => 'Az email cím formátuma érvénytelen.',
            'email.max' => 'Az email cím nem lehet hosszabb, mint 255 karakter.',
            'email.unique' => 'Ez az email cím már foglalt.',
            'password.required' => 'A jelszó megadása kötelező.',
            'password.string' => 'A jelszó csak szöveget tartalmazhat.',
            'password.min' => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'password.confirmed' => 'A jelszó megerősítése nem egyezik.',
        ];
    }
}
