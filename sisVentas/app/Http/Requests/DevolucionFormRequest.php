<?php

namespace sisVentas\Http\Requests;

use sisVentas\Http\Requests\Request;

class DevolucionFormRequest extends Request
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

                //'serie_comprobante'=>'max:7',
                //'num_comprobante'=>'required|max:10',
                //'tipo_comprobante'=>'required|max:20',
            'idcliente'=>'required',
            'iddetalle_venta'=>'required',
            'idarticulo'=>'required',
            'cantidad'=>'required',
            'cantidadnueva'=>'required',
            'precio_venta'=>'required',
            'descuento'=>'required',
            'total_venta'=>'required',
            'total_devolucion'=>'required',
            'tipo_devolucion'=>'required',
            'observaciones'
        ];
    }
}
