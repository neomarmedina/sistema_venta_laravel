<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use sisVentas\Parametros; // aqui estoy agregando el modelo Categoría a las librerias
use Illuminate\Support\Facades\Redirect;// hacemos referencia a Redirect porder hacer algunas redirecciones
use sisVentas\Http\Requests\ParametrosFormRequest;
Use DB;// Nos permitira instanciar esta clase.



class ParametrosController extends Controller
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

    			//declaro una variable $query(filtro de busqueda), el cual determinará cual será el texto de busqueda para poder filtrar todas las categorias
    			//aqui tenemos al objeto request utilizando el metodo get atraves de texto searchText
    			$query=trim($request->get('searchText'));

    			//definí la variables $categorias que utilzara´la clase DB, especificandole una tabla de donde se va aobtener los registros, utilzamos la sentencia where de laravel, definiendo el campo a buscar, %: nos indica que la busqueda es al principio o al final del texto, y que la condicion sea 1 y que ordene por idcategoria y de forma descendente, y que relaize la paginación de 7 en 7 registros y retornare a la vista index, enviandole como parametros la categoria que obtuvo en la variable $categoria, y el parametro searchText con el valor de la variable $query.

    			$parametros=DB::table('parametros')->where('nombre','LIKE','%'.$query.'%')
    			->where('condicion','=','1')
    			->where('nombre','LIKE','%'.$query.'%')
    			->orderBy('idparametro','desc')
    			->paginate(1000);
    			return view('configuracion.parametros.index',["parametros"=>$parametros,"searchText"=>$query]);


    		}


    }

    public function create()
    {

    			//Retornaremos a la vista create que esta dentro de las carpetas alamacen y categoria.
    			return view("configuracion.parametros.create");


    }
    
    
    //Recibe todos los datos enviados desde el formulario. esta funcion se utiliza para almacenar el objeto de modelo categoria en nuestra tabla categoria de la BD; comenzamos validando los parametros recibido en la función a travez del metodo request y luego guardar estos datos ingresados en el formulario en la base de datos. se realiza el registro que el usario solicitó
    public function store(ParametrosFormRequest $request) 
    {

    		//creae un objeto parametros aqui adentro el cual referenciará al modelo llamado categoria

    		$parametros= new Parametros;//creación de objeto
            

    		//ahora cargo cada atributo con los valores recibido de el formulario  campo de este objeto.

    		$parametros->codigo=$request->get('codigo');
    		$parametros->nombre=$request->get('nombre');
    		$parametros->valor=$request->get('valor');
    		$parametros->descripcion=$request->get('descripcion');

    		//cuando yo registre un parametros, esa parametros estará activa, por eso la colocamos en 1 osea condicion=1, cuando eliminimos una categoria de forma logica esta si pasara condicion=0.	
    		$parametros->condicion='1';

    		//luego de haber llenado el objeto categoria, procedemos a almacenarlos en la bd atravez dek metodo save()

    		$parametros->save();


    		//ahora retornamos un redireccion, la url ('almacen/categoria') para que nos muestres el estado de todas las categoria

    		return Redirect::to('configuracion/parametros');



    }

    //Esta funcion nos permitira mostrar datos de la base de datos, inicialmente va a recibir por parametro el id de la categoría que se va a mostrar, con la funcion findOrdFail($id) muestro la categoria especifica.
    public function show($id)
    {

    		//Aqui retornamos la vista show y le enviamos como parametros la categoria correpondiente al $id; atravez del llamado al modelo categoria 
    		return view("configuracion.parametros.show",["parametros"=>Parametros::findOrdFail($id)]);
    }

    //en este metodo vamos a editar los datos de una categoria en especifica.
    public function edit($id)
    {
    		//aqui llamo a mi formulario edit y le envio la categoria con los datos para modificarlos
    		return view("configuracion.parametros.edit",["parametros"=>Parametros::findOrFail($id)]);
    }
    		//este metodo se utilza para almacenar los datos que ya han sido previamente almacenados; con el objeto CategoriaFormRequest recibo los valores que ingresaron en el formulario vía parametros, con parametro $request valido previamente los datos que quiero modificar, tambien recibimos el $id como parametro, para saber la categoria especifica que vamos a actualizar.

    public function update(ParametrosFormRequest $request,$id)
    {


    		$parametros=parametros::findOrFail($id);//Aqui hago referencia al modelo categoria, y le envio la categoria especifica que quiero modificar
    		
    		//$parametros->codigo=$request->get('codigo');
    		//$parametros->nombre=$request->get('nombre');
    		$parametros->valor=$request->get('valor');
    		//$parametros->descripcion=$request->get('descripcion');

    		//cuando yo registre un parametros, esa parametros estará activa, por eso la colocamos en 1 osea condicion=1, cuando eliminimos una categoria de forma logica esta si pasara condicion=0.	
    		//$parametros->condicion='1';
    		$parametros->update();

    		return Redirect::to('configuracion/parametros');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria
            


    }

    //permirtirá destruir un objeto y eliminarlo tambien de la tabla respectiva en la base de datos.
    public function destroy($id)
    {
    		//voy hacer una modificacion de nuestro campo condición de "1" por "0" para que no se muestre en el listado de toda las otras categorías.
    		
    		$parametros=Parametros::findOrFail($id);//aqui seleccionamos la categoria que el usuario quiere eliminar.
    		$parametros->condicion='0';// aqui la igualamos a '0' para eliminarla logicamente.
    		$parametros->update();// Y aqui actualizo.
    		return Redirect::to('configuracion/parametros');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria
    }







}
