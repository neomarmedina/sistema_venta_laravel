<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;// agrego esto para poder subir la imagen desde la maquina del cliente a nuestro servidores
use sisVentas\Http\Requests\ArticuloFormRequest;
use sisVentas\Articulo;
use DB;
class ArticulosAgotadosController  extends Controller
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

                //declaro una variable $query(filtro de busqueda), el cual determinará cual será el texto de busqueda para poder filtrar todas las categorias
                //aqui tenemos al objeto request utilizando el metodo get atraves de texto searchText
                $query=trim($request->get('searchText'));

                //definí la variables $categorias que utilzara´la clase DB, especificandole una tabla de donde se va aobtener los registros, utilzamos la sentencia where de laravel, definiendo el campo a buscar, %: nos indica que la busqueda es al principio o al final del texto, y que la condicion sea 1 y que ordene por idcategoria y de forma descendente, y que relaize la paginación de 7 en 7 registros y retornare a la vista index, enviandole como parametros la categoria que obtuvo en la variable $categoria, y el parametro searchText con el valor de la variable $query.

                //a= tabla erticulo y c=tabla categroria
                // c.nombre as categoria (ahi lo que hago es pedir el nombre de la tabla categoria y renombrarlo con el nombre categoria)

                $condicion='10';//esta es numero guia para saber que producto esta agitado.    
                $articulos=DB::table('articulo as a')
                ->join('categoria as c','a.idcategoria','=','c.idcategoria')
                ->join('talla as tall','a.idtalla','=','tall.idtalla')

                ->select('a.idarticulo','a.nombre','a.codigo','a.stock','a.marca','a.modelo','c.nombre as categoria','a.descripcion','a.imagen','a.estado','a.idtalla','a.nombre','tall.nombre as talla')
                ->where('a.stock','<=',$condicion)
                ->paginate(1000);

                return view('almacen.articulos_agotados.index',["articulos"=>$articulos,"searchText"=>$query]);


            }


    }
    // en esta función enviaré a la vista la lista de categorias para que seleccionen en que categoría va a crear el articulo
    public function create()
    {       
                $categorias=DB::table('categoria')->where('condicion','=','1')->get();//aqui consulto en la bd todas las categorias que ten la bd y las obtengo con el metodo get


                 $talla=DB::table('talla')->get();

                //Retornaremos a la vista create que esta dentro de las carpetas almacen y categoria.
                return view("almacen.articulo.create",["categorias"=>$categorias,"talla"=>$talla]);//aqui retorno a la vista create de articulos y le retornos las categoriras encontradas en la base de datos.



  
    }
    
    
    //Recibe todos los datos enviados desde el formulario. esta funcion se utiliza para almacenar el objeto de modelo artuculo en nuestra tabla articulo de la BD; comenzamos validando los parametros recibido en la función a travez del metodo request y luego guardar estos datos ingresados en el formulario en la base de datos. se realiza el registro que el usuario solicitó
    public function store(ArticuloFormRequest $request) 
    {

           // dd($request);//ayuda a buscar el contenido de una variable a la hora de un error.
            //creae un objeto articulo aqui adentro el cual referenciará al modelo llamado Articulo

            $articulo= new Articulo;

            //ahora cargo cada atributo con los valores recibido del formulario  campo de este objeto.

            $articulo->idcategoria=$request->get('idcategoria');//aqui cargo la clave foranea, que representa la categoria a la que pertenecerá el articulo a crear.

            $articulo->idtalla=$request->get('idtalla');//aqui cargo la clave foranea, que representa la talla a la que pertenecerá el articulo a crear.
            $articulo->codigo=$request->get('codigo');
            $articulo->nombre=$request->get('nombre');
            //$articulo->stock=$request->get('stock');
            $articulo->stock='0';
            $articulo->descripcion=$request->get('descripcion');
            $articulo->marca=$request->get('marca');
            $articulo->modelo=$request->get('modelo');
            $articulo->estado='Activo';// este será el estado por defecto que tendra un articulo al ser creado.
            

            //debo agregar los siguientes campos para adaptarlo al sistema de ventas
            

            //$articulo->marca=$request->get('marca');
            //$articulo->modelo=$request->get('modelo');
            //$articulo->talla=$request->get('talla');
            // aqui valido la imagen que el isuario ingresará al sistema no este vacio, el objeto no este vacio. esto con el meotod hasFile

            if(Input::hasFile('imagen'))
            {

                $file=Input::file('imagen');// en la variable $file almacenaremos la imagen que tenemos en nuestro objeto de formulario llamafo imagene a travez del metodo  Input::file();

                //nuestro archivo file sera movido a la carpeta publica articulos que estará dentro de la carpeta llamada imagenes, y estas capetas las crearé con el metodo, y con el metpdo getClientOriginalName() establezco (creo de forma automatica) el nombre de ese archivo que estoy moviendo.

                // para el servidor seria:  $file->move(public_path().'../imagenes/articulos/',$file->getClientOriginalName());

                $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());   
                $articulo->imagen=$file->getClientOriginalName();      
            }

            

            //luego de haber llenado el objeto categoria, procedemos a almacenarlos en la bd atravez dek metodo save()

            $articulo->save();// aqui guardamos en la bd el articulo creado por el usuario


            //ahora retornamos un redireccion, la url ('almacen/articulo') para que nos muestres los articulos registrados

            return Redirect::to('almacen/articulo');



    }

    //Esta funcion nos permitira mostrar datos de la base de datos, inicialmente va a recibir por parametro el id de la categoría que se va a mostrar, con la funcion findOrdFail($id) muestro la categoria especifica.
    public function show($id)
    {

            //Aqui retornamos la vista show y le enviamos como parametros la categoria correpondiente al $id; atravez del llamado al modelo categoria 
            return view("almacen.articulo.show",["articulo"=>Articulo::findOrdFail($id)]);
    }

    //en este metodo vamos a editar los datos de una categoria en especifica por medio del $id
    public function edit($id)
    {
            $articulo=Articulo::findOrFail($id);//Aqui me traigo el articulo que el usuario seleccionó para editar.
            $categorias=DB::table('categoria')->where('condicion','=','1')->get();//aqui obntengo el listado de categoria al momento de editar un articulo, las categorias activas, con el metodo get.

            $talla=DB::table('talla')->get();

            //$bandera="Activo";

            //aqui llamo a mi formulario edit y le envio los articulo con los datos para modificarlos y las categorias para que seleccione el la categoria del articulo a modificar y lo retorno a la vista edit.
            return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias,"talla"=>$talla]);
    }
            //este metodo se utilza para almacenar los datos que ya han sido previamente almacenados; con el objeto CategoriaFormRequest recibo los valores que ingresaron en el formulario vía parametros, con parametro $request valido previamente los datos que quiero modificar, tambien recibimos el $id como parametro, para saber el articulo especificó que vamos a actualizar.

    public function update(ArticuloFormRequest $request,$id)
    {


            $articulo=Articulo::findOrFail($id);//Aqui hago referencia al modelo categoria, y le envio la categoria especifica que quiero modificar
        


            $articulo->idcategoria=$request->get('idcategoria');//aqui cargo la clave foranea, que representa la categoria a la que pertenecerá el articulo a crear.
            $articulo->idtalla=$request->get('idtalla');
            $articulo->codigo=$request->get('codigo');
            $articulo->nombre=$request->get('nombre');
            $articulo->stock=$request->get('stock');
            $articulo->descripcion=$request->get('descripcion');
            $articulo->marca=$request->get('marca');
            $articulo->modelo=$request->get('modelo');
            $articulo->estado=$estado=$request->get('estado');;// este será el estado por defecto que tendra un articulo al ser creado.

            // aqui valido la imagen que el isuario ingresará al sistema no este vacio, el objeto no este vacio. esto con el meotod hasFile

            if(Input::hasFile('imagen'))
            {

                $file=Input::file('imagen');// en la variable $file almacenaremos la imagen que tenemos en nuestro objeto de formulario llamafo imagene a travez del metodo  Input::file();

                //nuestro archivo file sera movido a la carpeta publica articulos que estará dentro de la carpeta llamada imagenes, y estas capetas las crearé con el metodo, y con el metpdo getClientOriginalName() establezco (creo de forma automatica) el nombre de ese archivo que estoy moviendo.

                $file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());   
                $articulo->imagen=$file->getClientOriginalName();          }




            $articulo->update();

            return Redirect::to('almacen/articulo');// aqui redireccionamos al archivo articulo que esta dentro de las carpetas almacen 



    }

    //permirtirá destruir un objeto y eliminarlo tambien de la tabla respectiva en la base de datos.
    public function destroy($id)
    {
            //voy hacer una modificacion de nuestro campo condición de "Activo" por "Inactivo" para que no se muestre en el listado de toda los articulos.
            
            $articulo=articulo::findOrFail($id);//aqui seleccionamos la categoria que el usuario quiere eliminar por medio del $id que recibimos por parametros.
            $articulo->estado='Inactivo';// aqui la igualamos a '0' para eliminarla logicamente.
            $articulo->update();// Y aqui actualizo.
            return Redirect::to('almacen/articulo');// aqui redireccionamos al archivo index que esta dentro de las carpetas almacen y categoria
    }

}
