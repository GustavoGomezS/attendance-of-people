<?php

namespace App\Http\Requests;

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
            'documentoVisitante' => 'required | max:15',
            'sexoVisitante' => 'required',
            'fechaNacimientoVisitante' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombreVisitante.required' => 'El nombre del Visitante es obligatorio!',
            'nombreVisitante.max' => 'El nombre tiene mas de 40 caracteres!',
            'telefonoVisitante.required' => 'El telefono del Visitante es obligatorio!',
            'telefonoVisitante.digits_between' => 'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoVisitante.numeric' => 'El telefono debe ser solo numeros!',
            'apellidoVisitante.required' => 'El apellido del Visitante es obligatorio!',
            'apellidoVisitante.max' => 'El apellido tiene mas de 40 caracteres!',
            'documentoVisitante.required' => 'El documento del Visitante es obligatorio!',
            'documentoVisitante.max' => 'El documento tiene mas de 15 caracteres!',
            'sexoVisitante.required' => 'El sexo del Visitante es obligatorio!',
            'fechaNacimientoVisitante.required' => 'La fecha de nacimiento del Visitante es obligatorio!',
        ];
    }
}
