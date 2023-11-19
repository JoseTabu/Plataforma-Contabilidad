<?php

namespace Plataforma\Http\Requests;

use Plataforma\Http\Requests\Request;

class GestoriaRequest extends Request
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
        return ['dni'=>'required|max:9|min:9',
                'clave'=>'required',
                'nombre'=>'required|max:15',



        ];
    }
}
