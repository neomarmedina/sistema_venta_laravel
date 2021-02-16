<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;// agrego esto para poder subir la imagen desde la maquina del cliente a nuestro servidores
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use DB;
class AvisoController extends Controller
{
  //aqui agregaremos nuestros metodos de la clase Articulo
    //Comenzamos declarando un costructor, el cual se utiliza para validar
    public function __construct()
    {

        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    		//si el objeto request existe entonces voy a obtener todos los registros de la tabla articulo de la base de datos.
    		if($request)
    		{

                   			
    			return view("avisos.aviso.index");

                //return Redirect::to('avisos/aviso');


    		}


    }
    
}
