<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'user_name.required' => 'El nombre de usuario es requerido',
            'user_name.max' => 'El nombre de usuario debe llevar 255 carácteres máximos',
            'email.required' => 'El email es requerido',
            'email.unique' => 'El email ya esta en la base de datos',
            'email.max' => 'El email debe llevar 255 carácteres máximos',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe llevar 6 carácteres minimos',
            'password.confirmed' => 'La contraseña debe ser igual',
        ];
    }
}
