<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarDistritoRequest extends FormRequest
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
            'id_mac' => 'required|numeric',
            'nombre' => 'required',
            'numero' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id_mac.required' => 'Elija un :attribute.',
            'nombre' => 'Ingrese el :attribute.',
            'numero' => 'Ingrese el :attribute.',
        ];
    }

    public function attributes()
    {
        return [
            'id_mac' => 'Macro Distrito',
            'nombre' => 'nombre de Distrito',
            'numero' => 'Número de Distrito',
        ];
    }
}
