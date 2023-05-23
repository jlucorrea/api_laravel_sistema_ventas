<?php

namespace App\Http\Requests;

use GuzzleHttp\Psr7\Message;
use Illuminate\Foundation\Http\FormRequest;

class ArticuloRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required',
        ];
    }

	public function messages()
	{
		return [
			// 'nombre.required' => 'Nombre del mensaje',
		];
	}
}
