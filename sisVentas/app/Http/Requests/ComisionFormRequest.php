<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class ComisionFormRequest extends Request
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
            //Estos son los nombre de los campos en el formulario, que seran validados automaticamente por laravel
                'idvendedor'=>'required',
                'anio'=>'required',
                'mes'=>'required',
                'quincena'=>'required'
                

        ];
    }
}
