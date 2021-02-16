<?php

namespace sisVentas\Http\Controllers;//viene por dedecto al crear el controlador

use Illuminate\Http\Request;//viene por dedecto al crear el controlador

use sisVentas\Http\Requests;//viene por dedecto al crear el controlador

use Illuminate\Support\Facades\Redirect;//nos permite hacer redirecciones
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\VentaFormRequest;//(Requests es el nombre de la carpeta donde se encuentra \VentaFormRequest) aqui hacemos referencia a nuestro VentaFormRequest
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use sisVentas\Parametros;// Esta la utilzo para recuperar el valo de los parametros
use DB;

use Carbon\Carbon;// con esto podremos utilizar el formarto de fecha y hora de nuestra zona horaria
Use Response;
Use Illuminate\Support\Collection;

class VentaController extends Controller
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

    			$ventas=DB::table('venta as v')
    			->join('persona as p','v.idcliente','=','p.idpersona')
    			->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                ->join('tienda as tiend','tiend.idtienda','=','v.idtienda')
    			->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.estatus_venta','vend.nombre AS vendedor','tiend.nombre AS tienda')
    			->where('v.num_comprobante','LIKE','%'.$query.'%')
                ->orwhere('v.estatus_venta','LIKE','%'.$query.'%')
                ->orwhere('v.fecha_hora','LIKE','%'.$query.'%')
                ->orwhere('v.num_comprobante','LIKE','%'.$query.'%')
                ->orwhere('serie_comprobante','LIKE','%'.$query.'%')
                ->orwhere('vend.nombre','LIKE','%'.$query.'%')


    			->orderBy('v.estatus_venta','desc')
    			->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado')
    			->paginate(1000);
    			return view('ventas.venta.index',["ventas"=>$ventas,"searchText"=>$query]);
    		}

    }
    			public function create()
    			{



    					//Aqui hago una consulta y la guardo en la variable $persona esto para poder mostrar todos os proveedores en un listado y el usuario pueda seleccionar el proveedor que le esta suministrando los articulos a nuestra empresa
    					$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();// aqui busco en la tabla persona, los registros que tipo_persona ='Proveedor', para mostrar solos los proveedores de la tabla persona.

                        //igual que el anterior scrypts
                        $tiendas=DB::table('tienda')->where('condicion','=','1')->get();

                        //igual que el anterior scrypts
                        $vendedores=DB::table('vendedor')->where('tipo_vendedor','=','Activo')->get();
                        
                         
                         
                         //para parametros email
                        $parametros=DB::table('parametros')->get();

                        foreach ($parametros as $parametros){
							if($parametros->idparametro=="2"){//factura
							    $valor_inicio_factura=$parametros->valor;
							}
								if($parametros->idparametro=="3"){//N°.Control
							    $valor_inicio_control=$parametros->valor;
							}
							
							if($parametros->idparametro=="4"){//Numero orden de pago
							    $valor_inicio_orden_pago=$parametros->valor;
							}
							
                        }
                        
                         //para ventas
                        $ventas=DB::table('venta')->get();

    
                        $serie_comprobante_total=0;
                        $num_comprobante_total=0;
                        
                        $serie_comprobante_total_N=0;
                        $num_comprobante_total_N=0;
                        
                        foreach ($ventas as $ventas){
                           
                               $serie_comprobante=$ventas->serie_comprobante;
                               $num_comprobante=$ventas->num_comprobante;

                              
                            if($ventas->tipo_comprobante=="Factura"){
							   
							    if($serie_comprobante>$serie_comprobante_total)
							    $serie_comprobante_total=$serie_comprobante;
							    
							   
							    if($num_comprobante>$num_comprobante_total)
							    $num_comprobante_total=$num_comprobante;
                            }
                            else{
                                
                                
							    if($serie_comprobante>$serie_comprobante_total_N)
							    $serie_comprobante_total_N=$serie_comprobante;
							    
							   
							    if($num_comprobante>$num_comprobante_total_N)
							    $num_comprobante_total_N=$num_comprobante;
                            }
                            }
                        
                        	$serie_comprobante_total++;
                        	$num_comprobante_total++;
                        	
                        	$serie_comprobante_total_N++;
                        	$num_comprobante_total_N++;
                        	
							 if($serie_comprobante_total<$valor_inicio_factura)
							     $serie_comprobante_total=$valor_inicio_factura+1;
							     
							 if($serie_comprobante_total_N<$valor_inicio_orden_pago)
							     $serie_comprobante_total_N=$valor_inicio_orden_pago+1;
							     
						
							     
							     
							 
                        
                        ////email
                         
						


    					//el metodo raw me sirve para concatenar el codigo del articulo con el nombre del articulo, para mostrar en una sola columna el código con el nombre del articulo, y estos dos campos que concateno les voy a poner el alias articulo, para tambien mostrar el listado de todos los articulos que el usuario puede seleccionar para registrar el ingreso de articulos, y en la consulta tambien extraemos e codigo del articulo por este es que se va a seleccionar en la tabla ingreso para indicar el articulo que esta ingresando a los almacenes. ojo mostraré solo los articulos cuyo estado sea = Activo

    					//el mtodo ->get() se utiliza para obtener todos los valores de las consulta a la bd realizada

    					//ojo: AVG: nos permite calcular un promedio entre los valores de un campo

    					$articulos = DB::table('articulo as art')
    						->join('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
    						->join('talla as tall','art.idtalla','=','tall.idtalla')
                            ->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','art.stock',DB::raw('max(di.precio_venta) as precio_promedio '),'tall.nombre AS talla')
    						->where('art.estado','=','Activo')
    						->where('art.stock','>','0')
    						->groupBy('articulo','art.idarticulo','art.stock')
    						->get();  


                            //Aqui me traigo el valor del iva de la bd para utilizaro en la interfaz
                            $iva=DB::table('parametros')->where('codigo','=','1')->get();
    						
    						return view("ventas.venta.create",["personas"=>$personas,"articulos"=>$articulos,"tiendas"=>$tiendas,"vendedores"=>$vendedores,'serie_comprobante_total' => $serie_comprobante_total,'num_comprobante_total' =>$num_comprobante_total,"iva"=>$iva,'serie_comprobante_total_N' => $serie_comprobante_total_N,'num_comprobante_total_N' =>$num_comprobante_total_N]);
    		
    		           



                }



    			//esta función me permitirá almacenar los datos que se ingresaron en el formulario de registrar ingreso de articulos y guardarlos en la base de datos, en esa funcion pasará un objeto de tipo $request del tipo : IngresoFormRequest para validar todos los datos que voy almacenar tanto como en el modelo ingreso como en el modelo detalle del ingreso

    				public function store(VentaFormRequest $request)
    				{

    						
    								//inicialmente voy a declarar un capturador de excepciones y dentro del try voy a iniciar una transaccion para garantizar que en caso que se esta relaizando un registro y se caiga la conexion al sistema no se haga la transaccíon o se realizan las dos o sea , primero el ingreso y despues el detalle de ingreso, pero deben registrse ambos para que no haya conflicto en la base de datos en caso contrario vamos a cancelar la transacción

    							try{

    									DB::beginTransaction();//inicio la transaccion

    										//Aqui agrego todos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingresados en el formulario para luego se enviado a la base de datos como un nuevo registro.

    									$venta=new Venta;// aqui declaro el objeto ingreso

    									//Aqui agrego toos los atributos del modelo que voy a registrar inicialmente, los cargos con los valores ingesesados en el formulario para luego se enviado a la base de datos como un nuevo registro.

    									$venta->idcliente=$request->get('idcliente');
                                        $venta->idvendedor=$request->get('idvendedor');
                                        $venta->idtienda=$request->get('idtienda');

                                        if($request->get('tipo_comprobante')==1)
                                        {
                                            $venta->tipo_comprobante='Nota de Entrega';

                                        }    

                                        if($request->get('tipo_comprobante')==2)
                                        {
                                            $venta->tipo_comprobante='Factura';

                                        } 




    									
    									$venta->serie_comprobante=$request->get('serie_comprobante');
    									$venta->num_comprobante=$request->get('num_comprobante');
    									$venta->total_venta=$request->get('total_venta');
    									
    									//aqui llamo la clase Carbon y le digo que me obtenga la fecha actual de mi  zona horaria de america/latina y me la guarde en la variable $mytime

    									$mytime = Carbon::now('America/Caracas');
    									
    									//aqui guardo este valor en el campo fecha_hora de la bd pero lo convierto al formato de fecha y hora con el metodo toDateTimeString().


    									$venta->fecha_hora=$mytime->toDateTimeString();
    									$venta->impuesto='18';
    									$venta->estado='A';
                                        $venta->estatus_venta=$request->get('estatus_venta');
    									$venta->save();// aqui guardo todos estos valores de ingreso la base de datos.


    									//ahora aqui recibo desde el mismo formulario los valores de detalle de ingreso para ser guardados tambien.

    									//ahora en vez de declarar un objeto; declararemos una variable que va a fncionar como un array, para recibir los valores que envían desde el forrmulario porue no recibire un valor por cada campo sino varios por cada campo, por eso sería un array de registros, asi que utilizaré una estructura iterativa while, para llenar los campos de la tabla detalle in

    									$idarticulo=$request->get('idarticulo');

    									$cantidad=$request->get('cantidad');
    									
    									$descuento=$request->get('descuento');

    									$precio_venta=$request->get('precio_venta');

    									$cont = 0;// este será mi contador para rrecorrar el array de los detalles del articulo

    									//este array de detalles va a ser enviado desde formulario registros de ingresos en la vista, y el while se ejecutará siempre y cuando el contador sea menor a los $idarticulos que se estan recibiendo como array, si tenemos un idarticulo se va a almacenar si tenemos 5, se van a recoorrer con el array.

    									while($cont < count($idarticulo)){

    										// aqui creamos un objeto llamado $detalle, que hará referencia a nuestro modelo detalle de ingreso, para guardar la informacio del formulario de la tabla detalle ingreso

    										$detalle = new DetalleVenta();//creo un objeto llamado detalle.
    										$detalle->idventa= $venta->idventa;// envío el idventa del objeto $venta que esta en la parte superior, que como se esta almacenando en la parte de arriba ya tiene un idventa autogenerado por mysql el cual se lo vamos a pasar a nuestra tabla detalle_venta como clave foranea

    										$detalle->idarticulo=$idarticulo[$cont];//aqui no guradará un valor sino una series de valores, o sea un idarticulo por cada registro, con esto .$idarticulo[$cont]; le estoy diciendo envía el valor de $idarticulo que esta en la posición x, ó sea o,1,2,3 o o sea ira contanto hasta la cantidad de registro que haya, aplica iguala para el resto de campo

    										$detalle->cantidad= $cantidad[$cont];

    										$detalle->descuento= $descuento[$cont];

    										$detalle->precio_venta= $precio_venta[$cont];

    										$detalle->save();


    										$cont=$cont+1;

    									}



    									   DB::commit();//finalizo la transacción
    								
    								        }catch(\Exception $e)
    								        {

    								        	echo $e;
    									DB::rollback();//aqui cancelo la transacción y resetea la operación e caso de haber algun inconveniente

			    					}


			    					//aqui llamo a mi vista respectiva

			    					return Redirect::to('ventas/venta');

    			    }

    				//esta función recibe el parametro id para mostrar el ingreso y detalle del  ingreso seleccionado, osea informacion de las tablas: ingreso, ingreso, detalles y persona

    			public function show ($id)
    			{

    					//declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consutal para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

    					//join= union de dos tablas por medio de dos campos en comun.



    					$venta = DB::table('venta as v')
    					->join('persona as p','v.idcliente','=','p.idpersona')
    					->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                        ->join('tienda as td','v.idtienda','=','td.idtienda')
                        ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
    					->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.estatus_venta','p.tipo_documento AS tipo_documento','p.num_documento AS num_documento','p.telefono AS telefono','vend.nombre AS vendedor','vend.num_documento AS cedula','vend.tipo_documento AS documento_vendedor','vend.telefono AS telefono','td.nombre AS tienda','td.direccion AS tienda_direccion','td.telefono AS tienda_tlf','td.rif AS tienda_rif')
    					->where('v.idventa','=',$id)
    					->first();//obtengo solo el primer registro que cumple a condici



    					//aqui declaro otra variable que en sí será un consutal para mostrar los detalles del ingreso
    					//ojo: en esta consulta en el select le estoy diciendo que el campo nombre de la tabla articulo o sea a.nombre, a ese valor retornado le voy a llamar ahora "articulo"
    					// el metodo get(); lo utilizo para obtener todo los detalles de dicha consulta

    					$detalles=DB::table('detalle_venta as d')
    					->join('articulo as a','d.idarticulo','=','a.idarticulo')
    					->select('a.nombre as articulo','a.codigo as codigo','a.descripcion as descripcion','d.cantidad','d.descuento','d.precio_venta')
    					->where('d.idventa','=',$id)
    					->get();


                        //Aqui me traigo el valor del iva de la bd para utilizaro en la interfaz
                            $iva=DB::table('parametros')->where('codigo','=','1')->get();

    					return view("ventas.venta.show",["venta"=>$venta,"detalles"=>$detalles,"iva"=>$iva]);


				}



//////////////////////////////// Editar


//en este metodo vamos a editar los datos de una categoria en especifica.
    public function edit($id)
    {
                
        
                        //declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consuta para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

                        //join= union de dos tablas por medio de dos campos en comun.



                        $venta = DB::table('venta as v')
                        ->join('persona as p','v.idcliente','=','p.idpersona')
                        ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                        ->join('tienda as td','v.idtienda','=','td.idtienda')
                        ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                        ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.estatus_venta','td.nombre AS tienda','p.tipo_documento AS tipo_documento','p.num_documento AS num_documento ','vend.nombre AS vendedor','vend.num_documento AS cedula','vend.tipo_documento AS documento_vendedor')
                        ->where('v.idventa','=',$id)
                        ->first();//obtengo solo el primer registro que cumple a condición


                        //aqui declaro otra variable que en sí será una consuta para mostrar los detalles del ingreso
                        //ojo: en esta consulta en el select le estoy diciendo que el campo nombre de la tabla articulo o sea a.nombre, a ese valor retornado le voy a llamar ahora "articulo"
                        // el metodo get(); lo utilizo para obtener todo los detalles de dicha consulta

                        $detalles=DB::table('detalle_venta as d')
                        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
                        ->select('a.nombre as articulo','a.codigo as codigo','a.imagen as imagen','a.descripcion as descripcion','d.cantidad','d.descuento','d.precio_venta')
                        ->where('d.idventa','=',$id)
                        ->get();
                        return view("ventas.devolucion.edit",["venta"=>$venta,"detalles"=>$detalles]);



        
    }





        //Este metodo lo vamos a utilizar solo para actualizar el estado de venta a A á C, o sea para anular la venta, recibe el $id de la venta que s eva anular, de la vista index del boton anular

    public function update($id)
    {

                            $mytime = Carbon::now('America/Caracas');
                                        
                                        //aqui guardo este valor en el campo fecha_hora de la bd pero lo convierto al formato de fecha y hora con el metodo toDateTimeString().
    

                    $venta=Venta::findOrFail($id);// con este metodo u creación de metodo. findOrdfail busco en la tabla Venta por el id el registro correspondiente, o sea busco un registro en especifico para modificarlo.
                    //$venta->estado='C';// EL estado lo cambio a C de cancelado.
                    $venta->estado='C';// EL estatus lo cambio a : Pagado
                        
                    echo $venta->estado; 
                    //$venta->fecha_pagada=$mytime->toDateTimeString();;//fecha en que se pagó la factura
                    $venta->update();

                    //echo "el id es ".$id; 
                    return Redirect::to('ventas/venta'); 
            
           


    }
  


//Deberia ser el eliminar pero lo voy a utilizar para cambiar el estatus de venta de por cobrar a pagada.               




				public function destroy($id)
				{

                    $mytime = Carbon::now('America/Caracas');
                                        
                                        //aqui guardo este valor en el campo fecha_hora de la bd pero lo convierto al formato de fecha y hora con el metodo toDateTimeString().
    

					$venta=Venta::findOrFail($id);// con este metodo u creación de metodo. findOrdfail busco en la tabla Venta por el id el registro correspondiente, o sea busco un registro en especifico para modificarlo.
					//$venta->estado='C';// EL estado lo cambio a C de cancelado.
                    $venta->estatus_venta='Pagado';// EL estatus lo cambio a : Pagado
					$venta->fecha_pagada=$mytime->toDateTimeString();;//fecha en que se pagó la factura
                    $venta->update();
                    //echo "carajooooooooooooooo";
					return Redirect::to('ventas/venta');


				}



    
}
