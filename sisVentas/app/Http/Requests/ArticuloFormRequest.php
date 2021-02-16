<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ArticuloFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //autorizo la entrada de datos al sistema y la carga de la ruta
    public function authorize()
    {
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //aqui valido que los campos no esten vacios o el maximo de caracteres
    

    public function rules()
    {
        return [
        'idcategoria'=>'required',
        'idtalla'=>'required',
        'codigo'=>'required|max:50',
        'nombre'=>'required|max:50',
        //'stock'=>'required|numeric',
        'descripcion'=>'max:50',
        'marca'=>'max:50',
        'modelo'=>'max:50',
        'unidad_medida'=>'max:50',
        'imagen'=>'mimes:jpeg,bmp,png',
        'estado'=>'max:512'
        

        ];
    }
}
