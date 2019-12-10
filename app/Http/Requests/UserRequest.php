<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Um nome é requerido.',
            'name.min'  => 'O nome deve ter pelo menos 5 digitos.',
            'name.max'  => 'O nome deve no máximo 255 digitos.',
            'email.required' => 'O email é exigido.',
            'email.email' => 'Este email está inválido.',
            'email.unique' => 'Esse email já está cadastrado.'
        ];
    }
}
