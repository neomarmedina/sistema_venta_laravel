<?php

namespace sisVentas\Http\Controllers;//viene por dedecto al crear el controlador

use Illuminate\Http\Request;//viene por deFecto al crear el controlador

use sisVentas\Http\Requests;//viene por dedecto al crear el controlador

use Illuminate\Support\Facades\Redirect;//nos permite hacer redirecciones
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\DevolucionFormRequest;//(Requests es el nombre de la carpeta donde se encuentra \VentaFormRequest) aqui hacemos referencia a nuestro VentaFormRequest
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use sisVentas\Devolucion;
use sisVentas\DetalleDevolucion;
use sisVentas\Parametros;// Esta la utilzo para recuperar el valo de los parametros
use DB;

use Carbon\Carbon;// con esto podremos utilizar el formarto de fecha y hora de nuestra zona horaria
Use Response;
Use Illuminate\Support\Collection;

class DevolucionController extends Controller
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

    			$devolucion = DB::table('devolucion as dev')
                            ->join('venta as v','dev.idventa','=','v.idventa')
                            ->select('dev.iddevolucion','dev.fecha_devolucion','dev.total_devolucion','dev.estatus','dev.tipo_devolucion','v.serie_comprobante as serie_comprobante','v.num_comprobante as num_comprobante')
                            ->where('dev.estado','=','1')
                            ->where('v.num_comprobante','LIKE','%'.$query.'%')
                            ->orwhere('v.serie_comprobante','LIKE','%'.$query.'%')
                            ->orderBy('dev.iddevolucion','desc')
                            ->paginate(1000);
                              
                            
                            return view("ventas.devolucion.index",["devolucion"=>$devolucion,"searchText"=>$query]);
            

    		}

    }
    			public function create()
    			{



    					//Aqui hago una consulta y la guardo en la variable $persona esto para poder mostrar todos los proveedores en un listado y el usuario pueda seleccionar el proveedor que le esta suministrando los articulos a nuestra empresa
    					$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();// aqui busco en la tabla persona, los registros que tipo_persona ='Proveedor', para mostrar solos los proveedores de la tabla persona.

                        //igual que el anterior scrypts
                        $tiendas=DB::table('tienda')->where('condicion','=','1')->get();

                        //igual que el anterior scrypts
                        $vendedores=DB::table('vendedor')->where('tipo_vendedor','=','Activo')->get();


    					//el metodo raw me sirve para concatenar el codigo del articulo con el nombre del articulo, para mostrar en una sola columna el código con el nombre del articulo, y estos dos campos que concateno les voy a poner el alias articulo, para tambien mostrar el listado de todos los articulos que el usuario puede seleccionar para registrar el ingreso de articulos, y en la consulta tambien extraemos e codigo del articulo por este es que se va a seleccionar en la tabla ingreso para indicar el articulo que esta ingresando a los almacenes. ojo mostraré solo los articulos cuyo estado sea = Activo

    					//el mtodo ->get() se utiliza para obtener todos los valores de las consulta a la bd realizada

    					//ojo: AVG: nos permite calcular un promedio entre los valores de un campo

    					$articulos = DB::table('devolucion as dev')
    						->join('venta as v','dev.idventa','=','v.idventa')
                            ->select('dev.iddevolucion','dev.fecha_devolucion','total_devolucion','dev.estatus','dev.tipo_devolucion','v.serie_comprobante as serie_comprobante','v.num_comprobante as num_comprobante')
    						->where('art.estado','=','1')
                            ->where('v.num_comprobante','LIKE','%'.$query.'%')
                            ->where('v.serie_comprobante','LIKE','%'.$query.'%')
                            ->orwhere('a.codigo','LIKE','%'.$query.'%')
    						->groupBy('art.idarticulo')
    						->get();  
    						
    						return view("ventas.devolucion.create",["personas"=>$personas,"articulos"=>$articulos,"tiendas"=>$tiendas,"vendedores"=>$vendedores]);
    		
    		                 /* 	
                            $articulos = DB::table('articulo as art')
                           ->join('talla as tall','art.idtalla','=','tall.idtalla')
                           ->select('art.codigo','art.nombre','art.idarticulo','tall.nombre AS talla')
                           ->where('art.estado','=','Activo')
                           ->get();


                           */
                              // ojo con esta linea de codigo, la comeente porq creo que esta demas
                            //return view("compras.ingreso.create",["personas"=>$personas,"articulos"=>$articulos]);






                }



    			//esta función me permitirá almacenar los datos que se ingresaron en el formulario devolucion (edit), el cual recibira todo esos parametros de la funcion update, que esta debajo de esta funcion

    				public function store($id,$total_devolucion,$tipo_devolucion,$observaciones,$iddetalle_venta,$idarticulo,$cantidadnueva,$precio_venta)
    				{

    						
    							

                                    //inicialmente voy a declarar un capturador de excepciones y dentro del try voy a iniciar una transaccion para garantizar que en caso que se esta relaizando un registro y se caiga la conexion al sistema no se haga la transaccíon o se realizan las dos o sea , primero el ingreso y despues el detalle de ingreso, pero deben registrse ambos para que no haya conflicto en la base de datos en caso contrario vamos a cancelar la transacción

                                try{

                                        DB::beginTransaction();//inicio la transaccion





    										//Aqui agrego todos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingresados en el formulario para luego se enviado a la base de adtos como un nuevo registro.

    									$devolucion=new Devolucion;// aqui declaro el objeto ingreso

    									//Aqui agrego toos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingesesados en el formulario para luego se enviado a la base de adtos como un nuevo registro.

    									$devolucion->idventa=$id;

                                            //aqui llamo la clase Carbon y le digo que me obtenga la fecga actual de mi la zona horaria de america/latina y me la guarde en la variable $mytime

                                        $mytime = Carbon::now('America/Caracas');
                                        
                                        //aqui guardo este valor en el campo fecha_hora de la bd pero lo convierto al formato de fecha y hora con el metodo toDateTimeString().


                                        $devolucion->fecha_devolucion=$mytime->toDateTimeString();
                                        $devolucion->total_devolucion=$total_devolucion;
    									$devolucion->tipo_devolucion=$tipo_devolucion;
                                        $devolucion->estatus='Pendiente';
                                        $devolucion->estado='1';
    									//$devolucion->observaciones=$observaciones;
    									
    									//aqui llamo la clase Carbon y le digo que me obtenga la fecga actual de mi la zona horaria de america/latina y me la guarde en la variable $mytime

    									$devolucion->save();// aqui guardo todos estos valores de ingreso la base de datos.


    									//ahora aqui recibo desde el mismo formulario los valores de detalle de devolucion para ser guardados tambien.

    									//ahora en vez de declarar un objeto; declararemos una variable que va a fncionar como un array, para recibir los valores que envían desde el forrmulario por ,medio de la funcio edit no recibire un valor por cada campo sino varios por cada campo, por eso sería un array de registros, asi que utilizaré una estructura iterativa while, para llenar los campos de la tabla detalle_devolucion

                                     
                                         $cont = 0;// este será mi contador para rrecorrar el array de los detalles del articulo

                                        //este array de detalles_devolucion va a ser enviado desde formulario registros de ingresos en la vista, y el while se ejecutará siempre y cuando el contador sea menor a los $idarticulos que se estan recibiendo como array, si tenemos un idarticulo se va a almacenar si tenemos 5, se van a recoorrer con el array, o sea va a guardar un registro por cada articulo.

                                        while($cont < count($idarticulo)){

                                            // aqui creamos un objeto llamado $detalle_devolucion, que hará referencia a nuestro modelo detalle de devolucion, para guardar la informacion del formulario de la tabla detalle de devolucion
                                            $detalle_devolucion = new DetalleDevolucion();//creo un objeto llamado DetalleDevolucion 
                                            $detalle_devolucion->iddevolucion=  $devolucion->iddevolucion;// envío el iddevolucion del objeto $devolucion que esta en la parte superior, que como se esta almacenando en la parte de arriba ya tiene un iddevolucion autogenerado por mysql el cual se lo vamos a pasar a nuestra tabla detalle_devolucion como clave foranea

                                            

                                            $detalle_devolucion->iddetalle_venta=$iddetalle_venta[$cont];

                                            $detalle_devolucion->idarticulo=$idarticulo[$cont];

                                            $detalle_devolucion->cantidadnueva=$cantidadnueva[$cont];



                                            $detalle_devolucion->observaciones=$observaciones[$cont];

                                             echo "observacion :".$observaciones[$cont];           


                                            $detalle_devolucion->precio_venta=$precio_venta[$cont];


                                       

                                            $detalle_devolucion->save();


                                            $cont=$cont+1;

                                        }







                                   DB::commit();//finalizo la transacción
                                    
                                            }catch(\Exception $e)
                                            {

                                                echo $e;
                                        DB::rollback();//aqui cancelo la transacción y resetea la operación e caso de haber algun inconveniente

                                    }
             



			    					//aqui llamo a mi vista respectiva

			    					return Redirect::to('ventas/devolucion');
                                    
    			    }

    			
                        //esta función recibe el parametro id para mostrar La devolucion y detalle de la devolucion seleccionada, osea informacion de las tablas: Devolcion, detalle_devolucion, detalles_venta 
                public function show ($id)
                {

                        //declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consutal para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

                        //join= union de dos tablas por medio de dos campos en comun.


                        //Esta consulta me permite traer todo los datos de los articulos devueltos, y traeras tanto numero de registros como articulo esten devueltos en una devolucion especifica seleccionada por el usuario    

                         $detalle_devolucion = DB::table('devolucion as d')
                            ->join('venta as v','d.idventa','=','v.idventa')
                            ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                            ->join('tienda as td','v.idtienda','=','td.idtienda')
                            ->join('detalle_devolucion as dv','d.iddevolucion','=','dv.iddevolucion')
                            ->join('detalle_venta as dtv','dv.iddetalle_venta','=','dtv.iddetalle_venta')
                            
                            ->join('articulo as art','dtv.idarticulo','=','art.idarticulo')
                            ->select('d.iddevolucion','d.fecha_devolucion','d.total_devolucion','d.estatus','d.tipo_devolucion','v.serie_comprobante as serie_comprobante','v.num_comprobante as num_comprobante','v.tipo_comprobante as tipo_comprobante','art.codigo as codigo','art.nombre as articulo','art.descripcion as descripcion','art.imagen as imagen','dtv.precio_venta as precio_venta','dtv.descuento as descuento','dv.cantidadnueva as cantidadnueva','dv.observaciones as observaciones','td.nombre AS tienda','vend.nombre AS vendedor')
                            ->where('d.estado','=','1')
                            ->where('d.iddevolucion','=',$id)
                            ->get();
                            
                        

                            //Esta consulta me permite traer todo los datos de los articulos devueltos, pero va a traer solo un registro cuando consiga una venta asociada a una devolucion    

                         $detalle_nota_credito = DB::table('devolucion as d')
                            ->join('venta as v','d.idventa','=','v.idventa')
                            ->join('persona as p','v.idcliente','=','p.idpersona')
                            ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                            ->join('tienda as td','v.idtienda','=','td.idtienda')
                            ->select('d.iddevolucion','d.fecha_devolucion','d.total_devolucion','d.estatus','d.tipo_devolucion','v.serie_comprobante as serie_comprobante','v.num_comprobante as num_comprobante','v.tipo_comprobante as tipo_comprobante','td.nombre AS tienda',DB::raw('CONCAT(vend.nombre, " - ",vend.tipo_documento, " : ",vend.num_documento) AS vendedor'),DB::raw('CONCAT(p.nombre, " - ",p.tipo_documento, " : ",p.num_documento, " - Tlf : ",p.telefono, "- Emai : ",p.email) AS cliente'),DB::raw('CONCAT(td.nombre) AS tienda'),DB::raw('CONCAT(td.descripcion) AS rubro'),DB::raw('CONCAT(td.direccion) AS domicilio'))
                            ->where('d.estado','=','1')
                            ->where('d.iddevolucion','=',$id)
                            ->get();
                            


                            
                             //Aqui me traigo el valor del iva de la bd para utilizaro en la interfaz
                            $parametros=DB::table('parametros as pm')
                            ->select('pm.idparametro','pm.codigo','pm.nombre','pm.valor','pm.descripcion')
                            ->where('codigo','=','1')
                            ->get();
                            
                            
                            /*
                             foreach ($parametros as $parametros){
                            echo $parametros->valor;

                                }
                            */

                            return view("ventas.devolucion.show",["devolucion"=>Devolucion::findOrFail($id),"detalle_devolucion"=>$detalle_devolucion,"detalle_nota_credito"=>$detalle_nota_credito,"parametros"=>$parametros]);    

                                

                }
    


//////////////////////////////// Editar



  //en esta funcion recibo de la vista index de venta el id de la venta en la cual se va a realizar la devolucion y realizo varias consultas con el id de la venta y envio todos lo datos relacionadas a la venta, lo envio a la interfaz de devolucion (edit de la carpeta devolucion) 
    public function edit($id)
    {



                //declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla venta con el alias "v", de la tabla persona con el alias "p", voy a unir con el campo idventa e idpersona en la tabla p, tambien unire la tabla tienda con la tabla venta, por medio de campo idtienda que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla tienda como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consuta para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

                        //join= union de dos tablas por medio de dos campos en comun.



                        $venta = DB::table('venta as v')
                        ->join('persona as p','v.idcliente','=','p.idpersona')
                        ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                        ->join('tienda as td','v.idtienda','=','td.idtienda')
                        ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                        ->select('v.idventa','v.idcliente','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.estatus_venta','td.nombre AS tienda','p.tipo_documento AS tipo_documento','p.num_documento AS num_documento ','vend.nombre AS vendedor','vend.num_documento AS cedula','vend.tipo_documento AS documento_vendedor')
                        ->where('v.idventa','=',$id)
                        ->first();//obtengo solo el primer registro que cumple a condición






                    //el metodo raw me sirve para concatenar el codigo del articulo con el nombre del articulo, para mostrar en una sola columna el código con el nombre del articulo, y estos dos campos que concateno les voy a poner el alias articulo, para tambien mostrar el listado de todos los articulos que el usuario puede seleccionar para registrar el ingreso de articulos, y en la consulta tambien extraemos e codigo del articulo por este es que se va a seleccionar en la tabla ingreso para indicar el articulo que esta ingresando a los almacenes. ojo mostraré solo los articulos cuyo estado sea = Activo

                        //el mtodo ->get() se utiliza para obtener todos los valores de las consulta a la bd realizada

                        //ojo: AVG: nos permite calcular un promedio entre los valores de un campo

                        $articulos = DB::table('articulo as art')
                            ->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
                            ->join('talla as tall','art.idtalla','=','tall.idtalla')
                            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','art.stock',DB::raw('avg(di.precio_venta) as precio_promedio'),'tall.nombre AS talla')
                            ->where('art.estado','=','Activo')
                            ->where('art.stock','>','0')
                            ->groupBy('articulo','art.idarticulo','art.stock')
                            ->get();  


    			
    	
    					
    					//aqui declaro otra variable que en sí será una consuta para mostrar los detalles del ingreso
    					//ojo: en esta consulta en el select le estoy diciendo que el campo nombre de la tabla articulo o sea a.nombre, a ese valor retornado le voy a llamar ahora "articulo"
    					// el metodo get(); lo utilizo para obtener todo los detalles de dicha consulta

    					$detalles=DB::table('detalle_venta as d')
    					->join('articulo as a','d.idarticulo','=','a.idarticulo')
    					->select('a.nombre as articulo','a.codigo as codigo','a.imagen as imagen','a.descripcion as descripcion','d.cantidad','d.iddetalle_venta','d.descuento','d.precio_venta','d.precio_venta','d.idarticulo')
    					->where('d.idventa','=',$id)
    					->get();


                          //Aqui me traigo el valor del iva de la bd para utilizaro en la interfaz
                            $parametros=DB::table('parametros as pm')
                            ->select('pm.idparametro','pm.codigo','pm.nombre','pm.valor','pm.descripcion')
                            ->where('codigo','=','1')
                            ->get();


    					return view("ventas.devolucion.edit",["venta"=>$venta,"detalles"=>$detalles,"articulos"=>$articulos,"parametros"=>$parametros]);



    	
    }
    		//este metodo se utilzará para almacenar los datos que ya han sido previamente cargados; con el objeto DevolucionFormRequest recibo los valores que ingresaron en el formulario edit(de la vista de devolucion) vía parametros, con parametro $request valido previamente los datos que quiero modificar, tambien recibimos el $id como parametro, para saber la venta que vamos a actualizar (editar con los nuevos datos).

     public function update(DevolucionFormRequest $request,$id)
    {

            // Aqui edito los valores de la venta, tomando en cuenta la ateraión por los articulos devueltos

    		$venta=Venta::findOrFail($id);//Aqui creo un objeto del modelo Venta que coincidan con el $id
    		
    		//estos son los nuevos valores que tomaran el registro de la Venta seleccionada por medio del $id

			$venta->total_venta=$request->get('total_venta')-$request->get('total_devolucion');// aqui guardó el objeto $vendedor con el tipo_documento enviado del formulario.
    		
    		$venta->update();


            ////////////////////// Ahora inserto en la tabla devolucion \\\\\\\\\\\




                $total_devolucion=$request->get('total_devolucion');// va para funcion store

                //$devolucion->tipo_devolucion=$request->get('tipo_devolucion');

                $tipo_devolucion=$request->get('tipo_devolucion');// va para funcion store


                $observaciones=$request->get('observaciones');// va para funcion store
               
                //ahora en vez de declarar un objeto; declararemos una variable que va a funcionar como un array, para recibir los valores que envían desde el forrmulario porue no recibire un valor por cada campo sino varios por cada campo, por eso sería un array de registros, asi que utilizaré una estructura iterativa while, para editar los campos de la tabla detalle_venta

                                        $idarticulo=$request->get('idarticulo');

                                        $cantidad=$request->get('cantidad');

                                         $cantidadnueva=$request->get('cantidadnueva');
                                        
                                        $descuento=$request->get('descuento');

                                        $precio_venta=$request->get('precio_venta');

                                        $iddetalle_venta=$request->get('iddetalle_venta');

                                        $cont = 0;// este será mi contador para rrecorrar el array de los detalles del articulo


                //este array de detalles va a ser enviado desde formulario edit(devolucion) de vista, y el while se ejecutará siempre y cuando el contador sea menor a los $idarticulos que se estan recibiendo como array, si tenemos un idarticulo se va a almacenar, si tenemos 5, se van a recoorrer con el array.

            while($cont < count($idarticulo))
            {
                //$venta->iddetalle_venta;//Este valor lo obtengo de la clase venta de arriba

                $detalle =DetalleVenta::findOrFail($iddetalle_venta[$cont]);//creo un objeto llamado

                
                $detalle->precio_venta=$precio_venta[$cont];
                
                $detalle->cantidad= $cantidad[$cont]-$cantidadnueva[$cont];
                


                $detalle->update();

                $cont=$cont+1;

            }

   		

            return $this->store($id,$total_devolucion,$tipo_devolucion,$observaciones,$iddetalle_venta,$idarticulo,$cantidadnueva,$precio_venta);//Estos datos se lo enviamos a la funcion: function store con los 3 parametros para que cree el pdf con la vista y los datos que se el esta pasando
                       

    }



///Deberia ser el eliminar pero lo voy a utilizar para cambiar el estatus de venta de por cobrar a pagada.               


				public function destroy($id)
				{

					$devolucion=Devolucion::findOrFail($id);// con este metodo u creación de metodo. findOrdfail busco en la tabla Venta por el id el registro correspondiente, o sea busco un registro en especifico para modificarlo.
					$devolucion->estatus='Ejecutada';// EL estado de la venta lo cambio a C de cancelado(anulado).
                    //$venta->estatus_venta='Pagado';// EL estatus lo cambio a : Pagado
					$devolucion->update();
					return Redirect::to('ventas/devolucion');


				}



    
}
