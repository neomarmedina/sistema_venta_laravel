<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class TiendaFormRequest extends Request
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
             'nombre'=>'required|max:100',
             'desccripcion'=>'max:100',
             'direccion'=>'max:100',
             'telefono'=>'max:100',
             'rif'=>'max:100',
             'codigo'=>'max:100'
             
        ];
    }
}
