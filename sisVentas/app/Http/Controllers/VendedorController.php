<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;


use sisVentas\Vendedor; // aqui estoy agregando el modelo Persona a las librerias
use Illuminate\Support\Facades\Redirect;// hacemos referencia a Redirect porder hacer algunas redirecciones
use sisVentas\Http\Requests\VendedorFormRequest;
Use DB;// Nos permitira instanciar esta clase.

class VendedorController extends Controller
{
    //aqui agregaremos nuestros metodos de la clase Persona
    //Comenzamos declarando un costructor, el cual se utiliza para validar
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request)
    {
    		//si el objeto request existe entonces voy a obtener todos los registros de la tabla persona de la base de datos.
    		if($request)
    		{

    			//declaro una variable $query(filtro de busqueda), el cual determinará cual será el texto de busqueda para poder filtrar todas las personas
    			//aqui tenemos al objeto request utilizando el metodo get atraves de texto searchText
    			$query=trim($request->get('searchText'));

    			//definí la variables $personas que utilzara´la clase DB, especificandole una tabla de donde se va aobtener los registros, utilzamos la sentencia where de laravel, definiendo el campo a buscar, %: nos indica que la busqueda es al principio o al final del texto, y que la condicion sea 1 y que ordene por idcategoria y de forma descendente, y que relaize la paginación de 7 en 7 registros y retornare a la vista index, enviandole como parametros la persona que obtuvo en la variable $personas, y el parametro searchText con el valor de la variable $query.

    			$vendedor=DB::table('vendedor')
    			->where('nombre','LIKE','%'.$query.'%')
    			->orwhere('num_documento','LIKE','%'.$query.'%')
    			->orderBy('idvendedor','desc')
    			->paginate(1000);
    			return view('tiendas.vendedor.index',["vendedores"=>$vendedor,"searchText"=>$query]);


    		}


    }

    public function create()
    {

    			//Retornaremos a la vista create que esta dentro de las carpetas ventas y cliente.
    			return view("tiendas.vendedor.create");


    }
    
    
    //Recibe todos los datos enviados desde el formulario por parametro a travez del objeto PersonaFormRequest esta funcion se utiliza para almacenar el objeto de modelo Persona en nuestra tabla Persona de la BD; comenzamos validando los parametros recibido en la función a travez del metodo request y luego guardar estos datos ingresados en el formulario en la base de datos. se realiza el registro que el usario solicitó
    public function store(VendedorFormRequest $request) 
    {

    		//creo un objeto Persona aqui adentro el cual referenciará al modelo llamado persona, esto para recibir los datos del formulario a travez del objeto request.

    		$vendedor= new Vendedor;//Instancio al modelo vendedor

    		//ahora cargo y envio por el metodo get cada atributo con los valores recibido del formulario  campo de este objeto.

    	
    		$vendedor->tipo_vendedor='Activo';// aqui guardó el objeto $persona el tipo_documento enviado del formulario.



    		$vendedor->nombre=$request->get('nombre');// aqui guardó el objeto $persona el nombre enviado del formulario.


    		$vendedor->tipo_documento=$request->get('tipo_documento');// aqui guardó el objeto $persona el tipo_documento enviado del formulario.

    		$vendedor->num_documento=$request->get('num_documento');// aqui en guardó el objeto $persona el numero de documento enviado del formulario.

    		$vendedor->direccion=$request->get('direccion');// aqui guardó en el objeto $persona la $direccion enviado del formulario.


    		$vendedor->telefono=$request->get('telefono');// aqui guardó el objeto $persona el tlf enviado del formulario.

    		//$persona->email=$request->get('email');// aqui guardó el objeto $persona el email enviado del formulario.

            $vendedor->email=$request->get('email');

            $vendedor->comision=$request->get('comision');


    		

    		//luego de haber llenado el objeto persona, procedemos a almacenarlos en la bd atravez del metodo save()

    		$vendedor->save();


    		//ahora retornamos un redireccion, la url ('ventas/cliente') para que nos muestres información de todas las personas

    		return Redirect::to('tiendas/vendedor');



    }

    //Esta funcion nos permitira mostrar datos de la base de datos, inicialmente va a recibir por parametro el id de la persona que se va a mostrar, con la funcion findOrdFail($id) muestro la persona especifica.
    public function show($id)
    {

    		//Aqui retornamos la vista show y le enviamos como parametros la persona correpondiente al $id; atravez del llamado al modelo categoria 
    		return view("tiendas.vendedor.show",["vendedor"=>Vendedor::findOrdFail($id)]);
    }

    //en este metodo vamos a editar los datos de una categoria en especifica.
    public function edit($id)
    {
    		//aqui llamo a mi formulario edit y le envio la persona con los datos especificos de la persona  que quiero modificar (editar). 
    		return view("tiendas.vendedor.edit",["vendedor"=>Vendedor::findOrFail($id)]);// redirecciono a mi formulario edit con los datos especifico de la persona que quiero editar.
    }
    		//este metodo se utilza para almacenar los datos que ya han sido previamente almacenados; con el objeto CategoriaFormRequest recibo los valores que ingresaron en el formulario edit vía parametros, con parametro $request valido previamente los datos que quiero modificar, tambien recibimos el $id como parametro, para saber la persona que vamos a actualizar (editar con los nuevos datos).

    public function update(VendedorFormRequest $request,$id)
    {


    		$vendedor=Vendedor::findOrFail($id);//Aqui Obtengo todos los datos del modelo Vendedro que coincidan con el $id
    		
    		//estos son los nuevos valores que tomaran el resgistro de la persona seleccionada ´por medio del $id

			$vendedor->tipo_vendedor=$request->get('tipo_vendedor');// aqui guardó el objeto $vendedor con el tipo_documento enviado del formulario.


    		$vendedor->nombre=$request->get('nombre');// aqui guardó el objeto $vendedor con el nombre enviado del formulario.

    		$vendedor->tipo_documento=$request->get('tipo_documento');// aqui guardó el objeto $vendedor con el tipo_documento enviado del formulario.

    		$vendedor->num_documento=$request->get('num_documento');// aqui en guardó el objeto $vendedor con el numero de documento enviado del formulario.

    		$vendedor->direccion=$request->get('direccion');// aqui guardó en el objeto $vendedor la $vendedor enviado del formulario.


    		$vendedor->telefono=$request->get('telefono');// aqui guardó el objeto $vendedor con el tlf enviado del formulario.

    		$vendedor->email=$request->get('email');// aqui guardó el objeto $vendedor con el email enviado del formulario.

            $vendedor->comision=$request->get('comision');// aqui guardó el objeto $vendedor con la comision enviadoa desde formulario.

    		$vendedor->update();// Aqui actualizo el objeto persona.

    		return Redirect::to('tiendas/vendedor');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria



    }

    //permirtirá destruir un objeto y eliminarlo tambien de la tabla respectiva en la base de datos.
    public function destroy($id)
    {
    		//voy hacer una modificacion de nuestro campo condición de "1" por "0" para que no se muestre en el listado de toda las otras categorías.
    		
    		$vendedor=Vendedor::findOrFail($id);//aqui seleccionamos la persona que el usuario quiere eliminar.
    		$vendedor->tipo_vendedor='Inactivo';// aqui la igualamos a '0' para eliminarla logicamente.
    		$vendedor->update();// Y aqui actualizo.
    		return Redirect::to('tiendas/vendedor');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria
    }
}
