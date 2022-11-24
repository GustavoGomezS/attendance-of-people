<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
            'documentoResidente' => ['required', 'max:15', 'digits_between:7,10', Rule::unique('residente', 'documentoResidente')->ignore($this->residente)],
            'sexoResidente' => 'required',
            'fechaNacimientoResidente' => 'required',
            'localidad' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'nombreResidente.required' => 'El nombre es obligatorio!',
            'nombreResidente.max' => 'El nombre tiene mas de 40 caracteres!',
            'telefonoResidente.required' => 'El telefono es obligatorio!',
            'telefonoResidente.digits_between' => 'El telefono debe tener entre 7 y 10 caracteres!',
            'telefonoResidente.numeric' => 'El telefono debe ser solo numeros!',
            'apellidoResidente.required' => 'El apellido es obligatorio!',
            'apellidoResidente.max' => 'El apellido tiene mas de 40 caracteres!',
            'documentoResidente.digits_between' => 'El documento debe tener de 7 a 15 caracteres!',
            'documentoResidente.required' => 'El documento es obligatorio!',
            'documentoResidente.unique' => 'El documento ya se encuentra registrado!',
            'sexoResidente.required' => 'El sexo es obligatorio!',
            'fechaNacimientoResidente.required' => 'La fecha de nacimiento es obligatoria!',
            'localidad.required' => 'La localidad es obligatoria!',
        ];
    }
}
