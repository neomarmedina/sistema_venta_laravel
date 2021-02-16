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

class NotaCreditoController extends Controller
{




    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {

    }
                public function create()
                {






                }



                //esta función me permitirá almacenar los datos que se ingresaron en el formulario devolucion (edit), el cual recibira todo esos parametros de la funcion update, que esta debajo de esta funcion

                    public function store()
                    {

                }



                 public function show ()
                {

                    $id=$_GET['iddevolucion'];//Aqui recibo de la la vista show de devolucion, enviada por una funcion jquery al controlador a la ruta Route::get('pfd/notacredito/{iddevolucion}','NotaCreditoController@show'); para poder imprimir la nota de credito o devolucion seleccionada por el susuario
                    //$id=19;

                    //echo $id;

                //en caso afirmativo que exista el request, obtendré todos los registros de la tabla Persona de la bd

                        //declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consutal para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

                        //join= union de dos tablas por medio de dos campos en comun.


                        //Esta consulta me permite traer todo los datos de los articulos devueltos, y traeras tanto numero de registros como articulo esten devueltos en una devolucion especifica seleccionada por el usuario    
                        //$id=19; 

                         $detalles_devolucion =  DB::table('devolucion as d')
                            ->join('venta as v','d.idventa','=','v.idventa')
                            ->join('persona as p','v.idcliente','=','p.idpersona')
                            ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                            ->join('tienda as td','v.idtienda','=','td.idtienda')
                            ->join('detalle_devolucion as dv','d.iddevolucion','=','dv.iddevolucion')
                            ->join('detalle_venta as dtv','dv.iddetalle_venta','=','dtv.iddetalle_venta')
                            
                            ->join('articulo as art','dtv.idarticulo','=','art.idarticulo')
                            ->select('d.iddevolucion','d.fecha_devolucion','d.total_devolucion','d.estatus','d.tipo_devolucion','v.serie_comprobante as serie_comprobante','v.num_comprobante as num_comprobante','v.tipo_comprobante as tipo_comprobante','art.codigo as codigo','art.unidad_medida as unidad_medida','art.nombre as articulo','art.descripcion as descripcion','art.imagen as imagen','dtv.precio_venta as precio_venta','dtv.descuento as descuento','dv.cantidadnueva as cantidadnueva','dv.observaciones as observaciones','td.nombre AS tienda','td.telefono AS tienda_tlf','td.codigo as codigo_tienda','td.rif as tienda_rif','td.direccion as tienda_direccion','vend.nombre AS vendedor','vend.num_documento AS cedula_vendedor','p.num_documento AS num_documento','p.telefono AS telefono_cliente','p.nombre AS cliente','p.direccion AS direccion_cliente','p.codigo AS codigo_cliente','p.tipo_documento AS tipo_documento')
                            ->where('d.estado','=','1')
                            ->where('d.iddevolucion','=',$id)
                            ->get();
                            
                        

                            //Esta consulta me permite traer todo los datos de los articulos devueltos, pero va a traer solo un registro cuando consiga una venta asociada a una devolucion y una detalle de venta por devolucion o sea por cada tipo de articulo devuelto   

                         $detalles = DB::table('detalle_devolucion as dv')
                            ->join('devolucion as d','dv.iddevolucion','=','d.iddevolucion')
                            ->join('articulo as art','dv.idarticulo','=','art.idarticulo')
                            ->select('dv.iddevolucion','d.fecha_devolucion as fecha_devolucion','d.total_devolucion as total_devolucion','dv.cantidadnueva as cantidadnueva','d.estatus as estatus','d.tipo_devolucion as tipo_devolucion','dv.precio_venta AS precio_venta','art.codigo AS codigo','art.descripcion AS descripcion','art.unidad_medida as unidad_medida')
                            ->where('dv.iddevolucion','=',$id)
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

                            return view("pdf.notacredito.index",["devolucion"=>Devolucion::findOrFail($id),"detalles"=>$detalles,"detalles_devolucion"=>$detalles_devolucion,"parametros"=>$parametros]);    

                                

                }
    


//////////////////////////////// Editar



  //en esta funcion recibo de la vista index de venta el id de la venta en la cual se va a realizar la devolucion y realizo varias consultas con el id de la venta y envio todos lo datos relacionadas a la venta, lo envio a la interfaz de devolucion (edit de la carpeta devolucion) 
    public function edit($id)
    {



    }



///Deberia ser el eliminar pero lo voy a utilizar para cambiar el estatus de venta de por cobrar a pagada.               


                public function destroy($id)
                {

                    

                }



    
}

