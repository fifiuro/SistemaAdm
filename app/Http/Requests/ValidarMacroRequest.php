<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarMacroRequest extends FormRequest
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
            'nombre_mac' => 'required',
            'numero_mac' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre_mac.required'=> 'El :attribute es necesario.',
            'numero_mac.required'=> 'EL :attribute es necesario.'
        ];
    }

    public function attributes()
    {
        return [
            'nombre_mac' => 'Nombre Macro Distrito',
            'numero_mac' => 'Número de Macro Distrito'
        ];
    }
}
