<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LoginFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
			'password' => 'required',
        ];
    }

	public function messages()
	{
		return [
            'email.required' => 'Correo requerido',
			'password.required' => 'Contraseña requerida'
        ];
	}
}