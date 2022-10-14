<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResidenteRequest extends FormRequest
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
            'nombreResidente' => 'required |max:40',
            'apellidoResidente' => 'required | max:40',
            'telefonoResidente' => 'required|digits_between:7,10|numeric',
            'estadoResidente' => 'required',
            'documentoResidente' => 'required | max:15',
            'sexoResidente' => 'required',
            'fechaNacimientoResidente' => 'required',
            'localidad' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombreResidente.required' => 'El nombre del Residente es obligatorio!',
            'nombreResidente.max' => 'El nombre tiene mas de 40 caracteres!',
            'telefonoResidente.required' => 'El telefono del Residente es obligatorio!',
            'telefonoResidente.digits_between' => 'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoResidente.numeric' => 'El telefono debe ser solo numeros!',
            'apellidoResidente.required' => 'El apellido del Residente es obligatorio!',
            'apellidoResidente.max' => 'El apellido tiene mas de 40 caracteres!',
            'estadoResidente' => 'El estado del Residente es obligatorio!',
            'documentoResidente.required' => 'El documento del Residente es obligatorio!',
            'documentoResidente.max' => 'El documento tiene mas de 15 caracteres!',
            'estadoResidente.required' => 'El estado del Residente es obligatorio!',
            'sexoResidente.required' => 'El sexo del Residente es obligatorio!',
            'fechaNacimientoResidente.required' => 'La fecha de nacimiento del Residente es obligatorio!',
            'localidad.required' => 'La localidad del Residente es obligatorio!',
        ];
    }
}
