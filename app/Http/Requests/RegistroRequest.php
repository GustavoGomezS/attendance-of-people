<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'visitante' => 'required',
            'autorizaFuncionario' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'visitante.required' => '¿Quien ingresa?',
            'autorizaFuncionario.required' => '¿Quien auoriza el ingreso?',
        ];
    }
}
