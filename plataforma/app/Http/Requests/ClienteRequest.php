<?php

namespace Plataforma\Http\Requests;

use Plataforma\Http\Requests\Request;

class ClienteRequest extends Request
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
            'dni'=>'required|min:9|max:9|unique:clientes',
            'nombre'=>'required',

        ];
    }
}
