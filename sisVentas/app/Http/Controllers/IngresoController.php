<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;



use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;//se utiliza para cargar imagenes
use sisVentas\Http\Requests\IngresoFormRequest;
use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;
use DB;

use Carbon\Carbon;// con esto podremos utilizar el formarto de fecha y hora de nuestra zona horaria
Use Response;
Use Illuminate\Support\Collection;
 	
class IngresoController extends Controller
{
    

	public function __construct()
    {
        $this->middleware('auth');

    }
    public function index(Request $request)
    {
    		//si el objeto request existe entonces voy a obtener todos los registros de la tabla persona de la base de datos.
    		if($request)
    		{

    			$query=trim($request->get('searchText'));//aqui se guarda la palabra de busqueda que ingresa el usuario, la funcion trim es para borrar los espacios de la palabra de busqueda tanto al inicio como al final

    			//$ingreso va hacer una consulta a la bd con la palabra de busqueda

    			$ingresos=DB::table('ingreso as i')
    			->join('persona as p','i.idproveedor','=','p.idpersona')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.num_comprobante','LIKE','%'.$query.'%')
    			->orderBy('i.idingreso','desc')
    			->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
    			->paginate(1000);
    			return view('compras.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
    		}

    }
    			public function create()
    			{



    					//Aqui hago una consulta y la guardo en la variable $persona esto para poder mostrar todos os proveedores en un listado y el usuario pueda seleccionar el proveedor que le esta suministrando los articulos a nuestra empresa
    					$personas=DB::table('persona')->where('tipo_persona','=','Proveedor')->get();// aqui busco en la tabla persona, los registros que tipo_persona ='Proveedor', para mostrar solos los proveedores de la tabla persona.

    					//el metodo raw me sirve para concatenar el codigo del articulo con el nombre del articulo, para mostrar en una sola columna el código con el nombre del articulo, y estos dos campos que concateno les voy a poner el alias articulo, para tambien mostrar el listado de todos los articulos que el usuario puede seleccionar para registrar el ingreso de articulos, y en la consulta tambien extraemos e codigo del articulo por este es que se va a seleccionar en la tabla ingreso para indicar el articulo que esta ingresando a los almacenes. ojo mostraré solo los articulos cuyo estado sea = Activo

    					//el mtodo ->get() se utiliza para obtener todos los valores de las consulta a la bd realizada

                        //->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','tall.nombre AS talla')


    					$articulos = DB::table('articulo as art')
    					   ->join('talla as tall','art.idtalla','=','tall.idtalla')
                           ->select('art.codigo','art.nombre','art.idarticulo','tall.nombre AS talla')
    					   ->where('art.estado','=','Activo')
    					   ->get();  
    						return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);
    		
    			}



    			//esta función me permitirá almacenar los datos que se ingresaron en el formulario de registrar ingreso de articulos y guardarlos en la base de datos, en esa funcion pasará un objeto de tipo $request del tipo : IngresoFormRequest para validar todos los datos que voy almacenar tanto como en el modelo ingreso como en el modelo detalle del ingreso

    				public function store(IngresoFormRequest $request)
    				{

    						
    								//inicialmente voy a declarar un capturador de excepciones y dentro del try voy a iniciar una transaccion para garantizar que en caso que se esta relaizando un registro y se caiga la conexion al sistema no se haga la transaccíon o se realizan las dos o sea , primero el ingreso y despues el detalle de ingreso, pero deben registrse ambos para que no haya conflicto en la base de datos en caso contrario vamos a cancelar la transacción

    							try{

    									DB::beginTransaction();//inicio la transaccion

    										//Aqui agrego todos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingresados en el formulario para luego se enviado a la base de adtos como un nuevo registro.

    									$ingreso=new Ingreso;// aqui declaro el objeto ingreso

    									//Aqui agrego toos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingesesados en el formulario para luego se enviado a la base de adtos como un nuevo registro.

    									$ingreso->idproveedor=$request->get('idproveedor');
    									$ingreso->tipo_comprobante=$request->get('tipo_comprobante');
    									$ingreso->serie_comprobante=$request->get('serie_comprobante');
    									$ingreso->num_comprobante=$request->get('num_comprobante');
    									
    									//aqui llamo la clase Carbon y le digo que me obtenga la fecga actual de mi la zona horaria de america/latina y me la guarde en la variable $mytime

    									$mytime = Carbon::now('America/Caracas');
    									
    									//aqui guardo este valor en el campo fecha_hora de la bd pero lo convierto al formato de fecha y hora con el metodo toDateTimeString().


    									$ingreso->fecha_hora=$mytime->toDateTimeString();
    									$ingreso->impuesto='16';//Este campo no cumple ninguna función ya que el iva es dinamico por la tabla parametros
    									$ingreso->estado='A';
    									$ingreso->save();// aqui guardo todos estos valores de ingreso la base de datos.


    									//ahora aqui recibo desde el mismo formulario los valores de detalle de ingreso para ser guardados tambien.

    									//ahora en vez de declarar un objeto; declararemos una variable que va a fncionar como un array. porue no recibire un valor por cada campo sino varios por cada campo, por eso sería un array de registros, asi que utilizaré una estructura iterativa while, para llenar los campos de la tabla detalle in

    									$idarticulo=$request->get('idarticulo');

    									$cantidad=$request->get('cantidad');
    									
    									$precio_compra=$request->get('precio_compra');

    									$precio_venta=$request->get('precio_venta');

    									$cont = 0;// este será mi contador para rrecorrar el array de los detalles del articulo

    									//este array de detalles va a ser enviado desde formulario registros de ingresos en la vista, y el while se ejecutará siempre y cuando el contador sea menor a los $idarticulos que se estan recibiendo como array, si tenemos un idarticulo se va a almacenar si tenemos 5, se van a recoorrer con el array.

    									while($cont < count($idarticulo)){

    										// aqui creamos un objeto llamado $detalle, que hará referencia a nuestro modelo detalle de ingreso, para guardar la informacio del formulario de la tabla detalle ingreso

    										$detalle = new DetalleIngreso();
    										$detalle->idingreso= $ingreso->idingreso;// envío el idingreso del onjrto$ingreso que esta en la parte superior, que como se esta almacenando en la parte de arriba ya tiene un idingreso autogenerado por mysql el cual se lo vamos a pasar a nuestra tabla detalle_ingreso como clave foranea

    										$detalle->idarticulo=$idarticulo[$cont];//aqui no guradará un valor sino una series de valores, o sea un idarticulo por cada registro, con esto .$idarticulo[$cont]; le estoy diciendo envía el valor de $idarticulo que esta en la posición x, ó sea o,1,2,3 o o sea ira contanto hasta la cantidad de registro que haya, aplica iguala para el resto de campo

    										$detalle->cantidad= $cantidad[$cont];

    										$detalle->precio_compra= $precio_compra[$cont];

    										$detalle->precio_venta= $precio_venta[$cont];

    										$detalle->save();


    										$cont=$cont+1;

    									}



    									   DB::commit();//finalizo la transacción
    								
    								        }catch(\Exception $e)
    								        {

    									DB::rollback();//aqui cancelo la transacción y resetea la operación e caso de haber algun inconveniente

			    					}


			    					//aqui llamo a mi vista respectiva

			    					return Redirect::to('compras/ingreso');

    			    }

    				//esta función recibe el parametro id para mostrar el ingreso y detalle del  ingreso seleccionado, osea informacion de las tablas: ingreso, ingreso, detalles y persona

    			public function show ($id)
    			{

    					//declaro una variable ingreso, que me guardará un ingreso en especifico, el cual puedo reutilizar el ingreso que declare arriba en la función index, que en si vendria siendo una consulta a la tabla ingreso, y obtendre datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consutal para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

    					//join= union de dos tablas por medio de dos campos en comun.



    					$ingreso = DB::table('ingreso as i')
    					->join('persona as p','i.idproveedor','=','p.idpersona')
    					->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    					->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    					->where('i.idingreso','=',$id)
    					->first();



    					//aqui declaro otra variable que en sí será un consutal para mostrar los detalles del ingreso
    					//ojo: en esta consulta en el select le estoy diciendo que el campo nombre de la tabla articulo o sea a.nombre, a ese valor retornado le voy a llamar ahora "articulo"
    					// el metodo get(); lo utilizo para obtener todo los detalles de dicha consulta

    					$detalles=DB::table('detalle_ingreso as d')
    					->join('articulo as a','d.idarticulo','=','a.idarticulo')
    					->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
    					->where('d.idingreso','=',$id)
    					->get();
    					return view("compras.ingreso.show",["ingreso"=>$ingreso,"detalles"=>$detalles]);


				}


	//crearé un metodo para la cancelación de ingresos

				public function destroy($id)
				{

					$ingreso=Ingreso::findOrfail($id);// con este metodo u creación de metodo. findOrdfail busco en la tabla Ingreso por el id el registro correspondiente, o sea busco un registro en especifico para modificarlo.
					$ingreso->estado='C';// EL estado lo cambio a C de cancelado.
					$ingreso->update();
					return Redirect::to('compras/ingreso');


				}


 }




