<?php

namespace Plataforma\Http\Requests;

use Plataforma\Http\Requests\Request;

class RegistroRequest extends Request
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
        return ['nombre'=>'required',
                'email'=>'required|email|max:255|unique:users',//Ponemos unique para no poder tener en la base de datos dos correos iguales
                'contraseña'=>'required',

        ];
    }
}
