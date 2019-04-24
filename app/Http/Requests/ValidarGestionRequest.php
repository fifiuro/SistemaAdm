<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidarGestionRequest extends FormRequest
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
            'gestion' => 'required|min:4|max:4',
        ];
    }

    public function messages()
    {
        return [
            'gestion.required' => 'La :attribute  es obligatorio',
            'gestion.max'=> 'La :attribute  no puedes ser mas de 4 dígitos.',
            'gestion.min'=> 'La :attribute  no puedes ser menos de 4 dígitos.'
        ];
    }

    public function attributes()
    {
        return [
            'gestion' => 'Gestión',
        ];
    }
}
