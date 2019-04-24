<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarUnidadRequest extends FormRequest
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
            'id_ges' => 'required',
            'unidad' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id_ges.required' => 'Seleccione una :attribute.',
            'unidad.required' => 'Ingrese el nombre de :attribute.'
        ];
    }

    public function attributes()
    {
        return [
            'id_ges' => 'Gestión',
            'unidad' => 'Unidad Ejecutora'
        ];
    }
}
