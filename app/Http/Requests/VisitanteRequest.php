<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VisitanteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->tipoUsuario == "1" &&  auth()->user()->estadoUsuario == "1") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombreVisitante' => 'required |max:40',
            'apellidoVisitante' => 'required | max:40',
            'telefonoVisitante' => 'required|digits_between:7,10|numeric',
            'documentoVisitante' => ['required', 'digits_between:7,10', Rule::unique('visitante', 'documentoVisitante')->ignore($this->visitante)],
            'sexoVisitante' => 'required',
            'fechaNacimientoVisitante' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombreVisitante.required' => 'El nombre es obligatorio!',
            'nombreVisitante.max' => 'El nombre tiene mas de 40 caracteres!',
            'telefonoVisitante.required' => 'El telefono es obligatorio!',
            'telefonoVisitante.digits_between' => 'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoVisitante.numeric' => 'El telefono debe ser solo numeros!',
            'apellidoVisitante.required' => 'El apellido es obligatorio!',
            'apellidoVisitante.max' => 'El apellido tiene mas de 40 caracteres!',
            'documentoVisitante.required' => 'El documento es obligatorio!',
            'documentoVisitante.digits_between' => 'El documento debe tener entre 7 y 15 caracteres!',
            'documentoVisitante.unique' => 'El documento ya se encuentra registrado!',
            'sexoVisitante.required' => 'El sexo es obligatorio!',
            'fechaNacimientoVisitante.required' => 'La fecha de nacimiento es obligatoria!',
        ];
    }
}
