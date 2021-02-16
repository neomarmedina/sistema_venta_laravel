<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\User; // aqui estoy agregando el modelo Persona a las librerias
use Illuminate\Support\Facades\Redirect;// hacemos referencia a Redirect porder hacer algunas redirecciones
use sisVentas\Http\Requests\UsuarioFormRequest;
use sisVentas\Http\Requests\EditarUsuarioFormRequest;
Use DB;// Nos permitira instanciar esta clase.



class UsuarioController extends Controller
{
    
    //Comenzamos declarando un costructor, el cual se utiliza para validar
    public function __construct()
    {
        //Aqui le digo, que todas las funciones de esta clase se ejecutarán si el usuario esta autentificado usando : $this->middleware('auth');
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    	if($request)
    	{

    					//declaro una variable $query(filtro de busqueda), el cual determinará cual será el texto de busqueda para poder filtrar todas las categorias
    			//aqui tenemos al objeto request utilizando el metodo get atraves de texto searchText
    			$query=trim($request->get('searchText'));

    			//definí la variables $categorias que utilzara´la clase DB, especificandole una tabla de donde se va aobtener los registros, utilzamos la sentencia where de laravel, definiendo el campo a buscar, %: nos indica que la busqueda es al principio o al final del texto, y que la condicion sea 1 y que ordene por idcategoria y de forma descendente, y que relaize la paginación de 7 en 7 registros y retornare a la vista index, enviandole como parametros la categoria que obtuvo en la variable $categoria, y el parametro searchText con el valor de la variable $query.

    			$usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
    			->orderBy('id','desc')
    			->paginate(1000);
    			return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);


    	}

    }

    public function create()
    {

    	return view('seguridad.usuario.create');

    }


 public function store(UsuarioFormRequest $request) 
    {

    		//creo un objeto Persona aqui adentro el cual referenciará al modelo llamado persona, esto para recibir los datos del formulario a travez del objeto request.

    		$usuario= new User;//Instancio al modelo User.

    		//ahora cargo y envio por el metodo get cada atributo con los valores recibido del formulario  campo de este objeto.

    		$usuario->name=$request->get('name');// aqui guardó en el objeto $name el nombre enviado del formulario.

			$usuario->email=$request->get('email');// aqui guardó en el objeto $name el email enviado del formulario.


    		$usuario->password=bcrypt($request->get('password'));// aqui guardó en el objeto $usuario el paswword enviado del formulario.
            //$usuario->tipoUsuario='1';
            $usuario->tipoUsuario=$request->get('tipoUsuario');// aqui guardó en el objeto $usuario el tipoUsuario enviado del formulario.            
                		
    		//luego de haber llenado el objeto usuario, procedemos a almacenarlos en la bd atravez del metodo save()

    		$usuario->save();


    		//ahora retornamos un redireccion, la url ('ventas/cliente') para que nos muestres información de todas las personas

    		return Redirect::to('seguridad/usuario');



    }

    public function edit($id)
    {

    	// con el metodo findOrfail($id) envio por parametro que coincida con el id del usuario que estan solicitando editar.

    	return view("seguridad.usuario.edit",["usuario"=>User::findOrfail($id)]);

    }


    public function update(EditarUsuarioFormRequest $request,$id)
    {


    		$usuario=User::findOrFail($id);//Aqui Obtengo todos los datos del modelo persona que coincidan con el $id
    		
    		//estos son los nuevos varlores que tomaran el resgistro de la persona seleccionada ´por medio del $id

    		
    		$usuario->name=$request->get('name');// aqui guardó en el objeto $name el nombre enviado del formulario.

			//$usuario->email=$request->get('email');// Este no seva a editar ya que si solo se quiere editar la contraseña y se deja el mismo correo cuandd se guarde va a chocar con el correo similar que está en la base de datos


    		$usuario->password=bcrypt($request->get('password'));// aqui guardó en el objeto $usuario el paswword enviado del formulario.

    		$usuario->tipoUsuario=$request->get('tipoUsuario');// aqui guardó en el objeto $usuario el tipoUsuario enviado del formulario.            

    		//luego de haber llenado el objeto usuario, procedemos a almacenarlos en la bd atravez del metodo save()

    		$usuario->save();

    		return Redirect::to('seguridad/usuario');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria



    }

    //permirtirá destruir un objeto y eliminarlo tambien de la tabla respectiva en la base de datos.
    public function destroy($id)
    {
    		
    		//aqui busco en la tabla el usaurio con el id que envian del formulario y lo elimino con el motodo delete()
    		$usuario=DB::table('users')->where('id','=', $id)->delete();

    		return Redirect::to('seguridad/usuario');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria
    }




}
