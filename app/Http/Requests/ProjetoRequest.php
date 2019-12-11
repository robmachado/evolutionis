<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjetoRequest extends FormRequest
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
            'nome' => ['required', 'string', 'min:5', 'max:255'],
            'descricao' => ['required', 'string'],
            'codigo'  => ['required', 'string'],
            'status' =>  ['integer', 'min:0', 'max:1'],
            'inicio' => ['date_format:Y-m-d'],
            'previsao' => ['date_format:Y-m-d', 'after:inicio'],
        ];
    }
}
