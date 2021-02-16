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

class FacturaController extends Controller
{




    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index(Request $request)
    {
          

    }
    
     public function create()
    {



                       

    }

                    //esta función recibe el parametro idventa para imprimir la factura relacionada a una venta ojo el id es el idventa que envio de la vista show
                public function show ()
                {

                      $id=$_GET['id'];//Aqui recibo de la la vista show de devolucion, enviada por una funcion jquery al controlador a la ruta Route::get('pfd/notacredito/{iddevolucion}','NotaCreditoController@show'); para poder imprimir la nota de credito o devolucion seleccionada por el susuario
                        //echo $id;

                      
                        //declaro una variable venta, que me guardará una venta en especifico, el cual puedo reutilizar la consulta venta que declare arriba en la función index, que en si vendria siendo una consulta a la tabla venta, y obtendré datos de la tabla ingreso con el alias "i", de la tabla persona con el alias "p", voy a unir con el campo idproveedor e idpersona en la tabla p, tambien unire la tabla ingreso con la tabla detalle ingreso, por medio de campo idingreso que es el campo comun entre ambos, y esto me pemitirá obtener información de la base de datos, tanto de la tabla ingreso como de la tabla persona en una consulta utilizando el recursos de los join. voy a utilizar el metodo first() en la consutal para solo obtener el primer ingreso que cumpla la condición que por logica debería ser un solo registro, el cumple con el id que se envía desde el formulario.

                        //join= union de dos tablas por medio de dos campos en comun.



                        $venta = DB::table('venta as v')
                        ->join('persona as p','v.idcliente','=','p.idpersona')
                        ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                        ->join('tienda as td','v.idtienda','=','td.idtienda')
                        ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                        ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta','v.estatus_venta','p.tipo_documento AS tipo_documento','p.num_documento AS num_documento','p.telefono AS telefono','vend.nombre AS vendedor','vend.num_documento AS cedula','vend.tipo_documento AS documento_vendedor','vend.telefono AS telefono','td.nombre AS tienda','td.direccion AS tienda_direccion','td.telefono AS tienda_tlf','td.rif AS tienda_rif')
                        ->where('v.idventa','=',$id)
                        ->get();


                        //aqui declaro otra variable que en sí será un consutal para mostrar los detalles del ingreso
                        //ojo: en esta consulta en el select le estoy diciendo que el campo nombre de la tabla articulo o sea a.nombre, a ese valor retornado le voy a llamar ahora "articulo"
                        // el metodo get(); lo utilizo para obtener todo los detalles de dicha consulta

                        $detalles=DB::table('detalle_venta as d')
                        ->join('articulo as a','d.idarticulo','=','a.idarticulo')
                        ->select('a.nombre as articulo','a.codigo as codigo','a.descripcion as descripcion','d.cantidad','d.descuento','d.precio_venta')
                        ->where('d.idventa','=',$id)
                        ->get();



                        ////////////Variables de sesiones para utiizarlas en el archivo pdf \\\\\\\\\\\\\\\\\



                        //Aqui rrecorro todos los datos obtenidos en la consulta
                        foreach ($venta as $ven)
                        {
                           //$tienda='tantoo';
                           //$direccion='los chaimas';  


                            //Aqui defino un array de datos                               
                            $session_vent = (object)array(

                                      'tienda'=>$ven->tienda,
                                      'direccion'=>$ven->tienda_direccion,
                                      



                                                            );

                            \Session::push('session_venta',$session_vent);//Aqui defino la variable de sesion


                        } 
                        
                        //De esta forma puedo imprimir el array a ver si esta guardando los datos bien
                        //dd(\Session::get('session_venta'));
                       
                        $session_venta=\Session::get('session_venta');//Aqui guardo la variable de sesion y de esta manera con el get obtengo lo que tengo en mi variable de sesssion para enviarle a la vista

                        return view('pdf.factura.index', ['session_venta'=>$session_venta]);// aqui envio la variable de sesion a la vpopmail_set_user_quota(user, domain, quota)
  
                        



                        //Aqui me traigo el valor del iva de la bd para utilizaro en la interfaz
                            $iva=DB::table('parametros')->where('codigo','=','1')->get();

                        //return view("pdf.factura.index",["venta"=>$venta,"detalles"=>$detalles,"iva"=>$iva]);


                }



//////////////////////////////// Editar


//en este metodo vamos a editar los datos de una categoria en especifica.
    public function edit($id)
    {
                
           


    }
  


//Deberia ser el eliminar pero lo voy a utilizar para cambiar el estatus de venta de por cobrar a pagada.               




                public function destroy($id)
                {


                }



    
}
