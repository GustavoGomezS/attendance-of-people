<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
      'nombreFuncionario' => 'required |max:40',
      'apellidoFuncionario' => 'required | max:40',
      'telefonoFuncionario' => 'required|digits_between:7,10|numeric',
      'documentoFuncionario' => ['required', 'max:15', 'digits_between:7,10', Rule::unique('funcionario', 'documentoFuncionario')->ignore($this->funcionario)],
      'sexoFuncionario' => 'required',
      'fechaNacimientoFuncionario' => 'required',
      'localidad' => 'required',
    ];
  }
  public function messages()
  {
    return [
      'nombreFuncionario.required' => 'El nombre es obligatorio!',
      'nombreFuncionario.max' => 'El nombre tiene mas de 40 caracteres!',
      'telefonoFuncionario.required' => 'El telefono es obligatorio!',
      'telefonoFuncionario.digits_between' => 'El telefono debe tener entre 7 y 10 caracteres!',
      'telefonoFuncionario.numeric' => 'El telefono debe ser solo numeros!',
      'apellidoFuncionario.required' => 'El apellido es obligatorio!',
      'apellidoFuncionario.max' => 'El apellido tiene mas de 40 caracteres!',
      'documentoFuncionario.digits_between' => 'El documento debe tener de 7 a 15 caracteres!',
      'documentoFuncionario.required' => 'El documento es obligatorio!',
      'documentoFuncionario.unique' => 'El documento ya se encuentra registrado!',
      'sexoFuncionario.required' => 'El sexo es obligatorio!',
      'fechaNacimientoFuncionario.required' => 'La fecha de nacimiento es obligatoria!',
      'localidad.required' => 'La localidad es obligatoria!',
    ];
  }
}
