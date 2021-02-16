<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Categoria; // aqui estoy agregando el modelo Categoría a las librerias
use Illuminate\Support\Facades\Redirect;// hacemos referencia a Redirect porder hacer algunas redirecciones
use sisVentas\Http\Requests\MensajeFormRequest;
Use DB;// Nos permitira instanciar esta clase.



class MensajeController  extends Controller
{
    //aqui agregaremos nuestros metodos de la clase categoria
    //Comenzamos declarando un costructor, el cual se utiliza para validar
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    		//si el objeto request existe entonces voy a obtener todos los registros de la tabla categoria de la base de datos.
    		if($request)
    		{

    		
    			return view('tiendas.comisiones.mensaje');


    		}


    

    }

}
