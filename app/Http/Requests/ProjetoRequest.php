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
            'nome' => ['required', 'string', 'min:5', 'max:100'],
            'descricao' => ['required', 'string'],
            'codigo'  => ['required', 'string', 'regex:/^[0-9]{4}[A-Za-z]{1,2}$/'],
            'inicio' => ['nullable','date_format:Y-m-d'],
            'previsao' => ['nullable','required_with:inicio', 'date_format:Y-m-d', 'after:inicio'],
            'fim' => ['nullable', 'date_format:Y-m-d', 'after:inicio'],
            'status' => ['required', 'integer','min:0','max:9'],
            'motivo' => ['nullable', 'required_with:fim', 'string'],
        ];
    }
}
