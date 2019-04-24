<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarVolumenRequest extends FormRequest
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
            'id_pro' => 'required|numeric',
            'fecha' => 'required',
            'monto' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id_pro.required' => 'Seleccione un :attribute.',
            'id_pro.numeric' => 'El :attribute debe ser un número valido.',
            'fecha.required' => 'La :attribute es requerido.',
            'monto.required' => 'El :attribute es requerido.',
            'monto.numeric' => 'El :attribute debe ser un número.'
        ];
    }

    public function attributes()
    {
        return [
            'id_pro' => 'Nombre Proyecto',
            'fecha' => 'Fecha',
            'monto' => 'Monto'
        ];
    }
}
