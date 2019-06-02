<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarProyectoRequest extends FormRequest
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
            'id_dist' => 'required|numeric',
            'id_ges' => 'required|numeric',
            'ema' => 'required',
            'presupuesto' => 'numeric',
            'fechaContrato' => 'required',
            'plazo' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id_dist.required' => 'Elija un :attribute.',
            'id_dist.numeric' => 'El :attribute debe ser un número.',
            'id_ges.required' => 'No se tiene seleccionada la :attribute.',
            'id_ges.numeric' => 'EL :attribute deber ser un número.',
            'ema.required' => 'El :attribute es requerido.',
            'presupuesto.numeric' => 'El :attribute deber ser un número.',
            'fechaContrato' => 'La fecha de Contrtrato es necesario.',
            'plazo' => 'El plazo de Contrato es necesario.',
        ];
    }

    public function attributes()
    {
        return [
            'id_dist' => 'Distrito',
            'id_ges' => 'Gestion',
            'ema' => 'EMA',
            'presupuesto' => 'Preupuesto',
        ];
    }
}
