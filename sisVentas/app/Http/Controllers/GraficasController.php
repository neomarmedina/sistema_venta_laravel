<?php
namespace sisVentas\Http\Controllers;
//namespace App\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
//use App\Http\Controllers\Controller;
//use App\User;
//use App\Publicaciones;
//use App\TipoPublicaciones;
use sisVentas\Articulo;
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use sisVentas\Ingreso;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //esta función devuelve el ultimo dia del mes, recibiendo el año y mes por parametros
    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

//en esta funcion chequeo cuanto registros tienes cada dia del mes seleccionado
// la adapatare a: cuantas ventas hay por dia.    

    public function registros_mes($anio,$mes)
    {
        $primer_dia=1;
        
        //aqui llamo la funcion que me devuelve el ultimo dia del mes, y guardo ese valor en $ultimo_dia
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);

        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        //y necesito traer todo los registros que estan en ese rango de fechas ó mes.
        //la setencia whereBetween me permite buscar registros que esten entre un rango de fechas
        // created_at es el campo fecha en la tabla de la bd
        $ventas=Venta::whereBetween('fecha_hora', [$fecha_inicial,  $fecha_final])->get();
        $ct=count($ventas);//aqui hago un conteo de los registros obtenido de la bd.


        //vamos a tener un mes que va a tener 30 dias, aqui lo defino
        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;//aqui definimos nuestro array de 30 dias.     
        }

        //aqui busco entre los registros, cuantos registros hay en cada dia del mes seleccionado y en caso de conseguir registro, los guarda por dias en la variable $diasel

        foreach($ventas as $ventas){
       //aqui verifico que exista un dia de cracion del registro
        $diasel=intval(date("d",strtotime($ventas->fecha_hora) ) );//aqui veo el dia que se creo el registro
        $registros[$diasel]++;//aqui incremento el numero de registro si pertenece a la fecha (dia) determinada , osea tantos registro en tal dia será el resultado   
        }

        //aqui en por json un array con total de dias del mes y numero de
        //registros por dia en el array $data. ojo $registros sería un array,
        //asi que enviaria un array dentro de otro array

        $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
        return   json_encode($data);
    }

/////////////////////////////////// compras por dia ///////////////////////////////////////////////


    public function compra_mes($anio,$mes)
    {
        $primer_dia=1;
        
        //aqui llamo la funcion que me devuelve el ultimo dia del mes, y guardo ese valor en $ultimo_dia
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);

        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );

        //y necesito traer todo los registros que estan en ese rango de fechas ó mes.
        //la setencia whereBetween me permite buscar registros que esten entre un rango de fechas
        // created_at es el campo fecha en la tabla de la bd
        $ingreso=Ingreso::whereBetween('fecha_hora', [$fecha_inicial,  $fecha_final])->get();
        $ct=count($ingreso);//aqui hago un conteo de los registros obtenido de la bd.


        //vamos a tener un mes que va a tener 30 dias, aqui lo defino
        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;//aqui definimos nuestro array de 30 dias.     
        }

        //aqui busco entre los registros, cuantos registros hay en cada dia del mes seleccionado y en caso de conseguir registro, los guarda por dias en la variable $diasel

        foreach($ingreso as $ingreso){
       //aqui verifico que exista un dia de cracion del registro
        $diasel=intval(date("d",strtotime($ingreso->fecha_hora) ) );//aqui veo el dia que se creo el registro
        $registros[$diasel]++;//aqui incremento el numero de registro si pertenece a la fecha (dia) determinada , osea tantos registro en tal dia será el resultado   
        }

        //aqui en por json un array con total de dias del mes y numero de
        //registros por dia en el array $data. ojo $registros sería un array,
        //asi que enviaria un array dentro de otro array

        $data=array("totaldiascompra"=>$ultimo_dia, "registrosdiacompra" =>$registros);
        return   json_encode($data);
    }


//la adaptare a los articulos mas vendidos

    public function total_publicaciones(){
        //$tipospublicacion=TipoPublicaciones::all();
        $articulos=articulo::all();//trae todo los articulos existentes, esto lo enviare como parametro, para que me indique en lps tipos de articulos en la grafica a mdodo de leyenda
        //$ctp=count($tipospublicacion);
        $ctp=count($articulos);//cuenta todo los articulos existentes
        
        //$publicaciones=Publicaciones::all();
        $ventas=DetalleVenta::all();//me traigo todas las ventas de la tabla detalles venta porq esta relacionada con el articulo
        $ct =count($ventas);//cuento todas las ventas
        
        //este array va a aguardar todo los articulos en un vector con su respectivo id para saber caules son los articulos ue tengo resgitrado en mi bd
        for($i=0;$i<=$ctp-1;$i++){
         $idA=$articulos[$i]->idarticulo;//(idarticulo es el pk de la tabla articulo)aqui obtengo el id de cada articulo de la tabla articulo
         $numerodearticulo[$idA]=0;//esto es un array que tiene por indice el id de cada articulo y de esa manera puedo saber que articulos tengo en mi base de datos
        }

        //aqui me va a contar todas las ventas que hay en el la bd relaconadas a un articulo, ct=ventas

        for($i=0;$i<=$ct-1;$i++){
         $idA=$ventas[$i]->idarticulo;//(idarticulo es clave kf en la tabla detallesventas)aqui relaciono ventas con articulo atravez de los pk (id), ahi va recorriendo las ventas y las ventas tienen un campo que se llama idarticulo
         $numerodearticulo[$idA]++;//Aqui el $idA (Id de la venta con un atriculo asociado o medio fk) sera el indice del vector de numero de articulos, obtengo el numero de ventas relacionada a un articulo(o viceversa), esto es un vector que contiene el numero deveces que se vende cada articulo. paara saber cual es el articulo mas vendido.<s
           
        }

        ///aqui envio todo los articulos que tengo y el numero de ventas de cada articulos, ctp=total de  articulos existentes, numerodearticulo = numero de ventas por cada tipo dearticulo, tipos= es un vector que contiene los distintos tipos de articulos

        $data=array("totaltipos"=>$ctp,"tipos"=>$articulos, "numerodepubli"=>$numerodearticulo);
        return json_encode($data);//aqui envio por json todos estos valores a la interfaz (grafica)
    }


    public function index()
    {
        $anio=date("Y");//obtenemos el año actual
        $mes=date("m");//obtenemos el mes actual
        //De esta forma retornaba en el sistema donde fue creado.(cursos plusis)
        /*return view("listados.listado_graficas")
               ->with("anio",$anio)
               ->with("mes",$mes);*/ 
        //return view('listados.listado_graficas',["anio"=>$anio,"mes"=>$mes]);
               //return view("listado.graficas.create");

               return view('listado.graficas.create',["anio"=>$anio,"mes"=>$mes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
