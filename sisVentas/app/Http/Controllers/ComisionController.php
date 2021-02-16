<?php
namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\ComisionFormRequest;
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use DB;

use Carbon\Carbon;// con esto podremos utilizar el formarto de fecha y hora de nuestra zona horaria
Use Response;
Use Illuminate\Support\Collection;

class ComisionController extends Controller
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

                //declaro una variable $query(filtro de busqueda), el cual determinará cual será el texto de busqueda para poder filtrar todas los vendedores
                //aqui tenemos al objeto request utilizando el metodo get atraves de texto searchText
                $query=trim($request->get('searchText'));

                //definí la variables $personas que utilzará la clase DB, especificandole una tabla de donde se va aobtener los registros, utilzamos la sentencia where de laravel, definiendo el campo a buscar, %: nos indica que la busqueda es al principio o al final del texto, y que la condicion sea 1 y que ordene por idcategoria y de forma descendente, y que relaize la paginación de 7 en 7 registros y retornare a la vista index, enviandole como parametros la persona que obtuvo en la variable $personas, y el parametro searchText con el valor de la variable $query.

                $vendedor=DB::table('vendedor')
                ->where('nombre','LIKE','%'.$query.'%')
                ->orwhere('num_documento','LIKE','%'.$query.'%')
                ->orderBy('idvendedor','desc')
                ->paginate(7);
                return view('tiendas.comisiones.index',["vendedores"=>$vendedor,"searchText"=>$query]);


            }


    }


 //esta función devuelve el ultimo dia del mes, recibiendo el año y mes por parametros
    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }


 //Recibe todos los datos enviados desde el formulario por parametro a travez del objeto ComisionFormRequest, esta funcion se utilizará para almacenar el objeto de modelo vendedor en nuestra tabla Persona de la BD; comenzamos validando los parametros recibido en la función a travez del metodo request y luego guardar estos datos ingresados en el formulario en la base de datos. se realiza el registro que el usario solicitó
    public function store(ComisionFormRequest $request) 
    {

           
            //ahora cargo cada atributo con los valores recibido de el formulario  campo de este objeto.



            $idvendedor=$request->get('idvendedor');
            //echo "el id del vendedor es:".$idvendedor."</br>";

             $anio=$request->get('anio');
            //echo "el anio del vendedor es:".$anio."</br>";

             $mes=$request->get('mes');
            //echo "el mes del vendedor es:".$mes;


             $quincena=$request->get('quincena');
             //echo "la quincena es:".$quincena;

             //$valor_comision=$request->get('valor_comision');
            //echo "La comisión del vendedor es:".$valor_comision;

            



        ////////////// aqui hago el calculo de comisiones \\\\\\\\\\\\\


           $primer_dia=1;
           $quince_dia=15;
        
        //aqui llamo la funcion que me devuelve el ultimo dia del mes, y guardo ese valor en $ultimo_dia
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);


        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_quincena=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$quince_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        //y necesito traer todo los registros que estan en ese rango de fechas ó mes.
        //la setencia whereBetween me permite buscar registros que esten entre un rango de fechas
        // created_at (fecha hora) es el campo fecha en la tabla de la bd
        

       // $ventas=Venta::whereBetween('fecha_hora', [$fecha_inicial,  $fecha_final])->get();
        

       

        //idea general: aqui busco entre los registros, cuantos registros hay en cada dia del mes seleccionado y en caso de conseguir registro, los guarda por dias en la variable $diasel
        
        //idea especifica :con el foreach recorro todos los registros del vector $venta que me traje de la bd que cumplian con la intervalo de fecha ingresado por el usuario
        


/////// Aqui obtengo los datos de cada venta


        if($quincena=='1')
        {    


                   $datos_ventas=DB::table('venta as v')
                ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                ->join('persona as p','v.idcliente','=','p.idpersona')
                ->join('tienda as td','v.idtienda','=','td.idtienda')
                ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.total_venta','v.fecha_hora','v.fecha_pagada','v.serie_comprobante','vend.nombre AS vendedor','td.nombre AS tienda','vend.comision AS comision','dv.cantidad AS cantidad','dv.precio_venta AS precio_venta','dv.cantidad AS cantidad','dv.descuento AS descuento','p.nombre as cliente')
                ->where('v.idvendedor','=',$idvendedor)
                ->where('v.fecha_pagada','>=',$fecha_inicial)
                ->where('v.fecha_pagada','<=',$fecha_quincena)
                ->where('v.estatus_venta','=','Pagado')
                 ->orderBy('v.idventa','desc')
                ->paginate(7);
                $ct=count($datos_ventas);//aqui hago un conteo de los registros obtenido de la bd.
                

                if($ct<=0)
                  {
                    ?>
                    <!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
                      <meta http-equiv="refresh" content="0; /mensaje" />
                    <?php
                   } 
                   else
                   {

             

                        // Haré esto para poder enviar el valor de la comision como un array, en todas las posiciones del array tendrá el mismo valor



                        //aqui en por json un array con total de dias del mes y numero de
                        //registros por dia en el array $data. ojo $registros sería un array,
                        //asi que enviaria un array dentro de otro array

                        //$data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
                        //return   json_encode($data);  
         
                        return view('tiendas.comisiones.ver',["datos_ventas"=>$datos_ventas]);

                     }


    }



///////////////////////////////


                if($quincena==2)
                {    
                    

                   $datos_ventas=DB::table('venta as v')
                ->join('vendedor as vend','v.idvendedor','=','vend.idvendedor')
                ->join('persona as p','v.idcliente','=','p.idpersona')
                ->join('tienda as td','v.idtienda','=','td.idtienda')
                ->join('detalle_venta as dv','v.idventa','=','dv.idventa')
                ->select('v.idventa','v.total_venta','v.fecha_hora','v.fecha_pagada','v.serie_comprobante','vend.nombre AS vendedor','td.nombre AS tienda','vend.comision AS comision','dv.cantidad AS cantidad','p.nombre as cliente','dv.precio_venta AS precio_venta','dv.cantidad AS cantidad','dv.descuento AS descuento')
                ->where('v.idvendedor','=',$idvendedor)
                ->where('v.fecha_pagada','>=',$fecha_quincena)
                ->where('v.fecha_pagada','<=',$fecha_final)
                ->where('v.estatus_venta','=','Pagado')
                 ->orderBy('v.idventa','desc')
                ->paginate(7);
                $ct=count($datos_ventas);//aqui hago un conteo de los registros obtenido de la bd.
                

                if($ct<=0)
                  {
                    ?>
                    <!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
                      <meta http-equiv="refresh" content="0; /mensaje" />
                    <?php
                   } 
                   else
                   {

             

                        // Haré esto para poder enviar el valor de la comision como un array, en todas las posiciones del array tendrá el mismo valor



                        //aqui en por json un array con total de dias del mes y numero de
                        //registros por dia en el array $data. ojo $registros sería un array,
                        //asi que enviaria un array dentro de otro array

                        //$data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
                        //return   json_encode($data);  
         
                        return view('tiendas.comisiones.ver',["datos_ventas"=>$datos_ventas]);

                     }


    }









/////////////////////////////////////////////

    }


}
