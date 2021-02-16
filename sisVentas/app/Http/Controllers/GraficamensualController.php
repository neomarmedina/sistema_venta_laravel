<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisVentas\Http\Requests\GraficamensualFormRequest;
use sisVentas\Articulo;
use sisVentas\Venta;
use sisVentas\DetalleVenta;
use sisVentas\Ingreso;
use sisVentas\DetalleIngreso;
use sisVentas\Talla;
use sisVentas\Ciente;
use DB;

use Carbon\Carbon;// con esto podremos utilizar el formarto de fecha y hora de nuestra zona horaria
Use Response;
Use Illuminate\Support\Collection;

class GraficamensualController extends Controller
{




	public function __construct()
    {
        $this->middleware('auth');
        
    }




    public function index(Request $request)
    {
    		


        $anio=date("Y");//obtenemos el a帽o actual
        $mes=date("m");//obtenemos el mes actual
        //De esta forma retornaba en el sistema donde fue creado.(cursos plusis)
        /*return view("listados.listado_graficas")
               ->with("anio",$anio)
               ->with("mes",$mes);*/ 
        //return view('listados.listado_graficas',["anio"=>$anio,"mes"=>$mes]);
               //return view("listado.graficas.create");

               return view('listado.graficas2.index',["anio"=>$anio,"mes"=>$mes]);




    }


    public function create(GraficamensualFormRequest $request)
    {

          






    }


      //esta funci贸n devuelve el ultimo dia del mes, recibiendo el a帽o y mes por parametros
    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }

    public function store()
    {
        //echo " el anio es ".$anio;

        //$anio = $_POST['anio'];
        $anio = $_GET['anio'];



    $condicion = $_GET['condicion'];
    if($condicion=='grafica1' or $condicion=='grafica2' or $condicion=='grafica4')
    {


        ///////////Calculo de Fecha actual\\\\\\\\\\

         
        $anio_actual=date("Y");//obtenemos el año actual
        $mes_actual=date("m");//obtenemos el mes actual
        $dia_actual=date("d");//obtenemos el dia actual
        
        //////Ahora tranforma la fecha actual en un formato valido para las consultas año-mes-dia \\\\
        
        $fecha_actual=date("Y-m-d H:i:s", strtotime($anio_actual."-".$mes_actual."-".$dia_actual));




        //$anio=$request->get('anio');
        
        //$anio=2019;
        $ene=1;
        $feb=2;
        $mar=3;
        $ab=4;
        $may=5;
        $jun=6;
        $jul=7;
        $ag=8;
        $sep=9;
        $oct=10;
        $nov=11;
        $dic=12;

// aqui comento yoni

        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_enero=$this->getUltimoDiaMes($anio,$ene);
        $primer_dia=1;
        
        $fecha_inicial_enero=date("Y-m-d H:i:s", strtotime($anio."-".$ene."-".$primer_dia) );
        $fecha_final_enero=date("Y-m-d H:i:s", strtotime($anio."-".$ene."-".$ultimo_dia_enero) );

        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_febrero=$this->getUltimoDiaMes($anio,$feb);
    
        
        $fecha_inicial_febrero=date("Y-m-d H:i:s", strtotime($anio."-".$feb."-".$primer_dia) );
        $fecha_final_febrero=date("Y-m-d H:i:s", strtotime($anio."-".$feb."-".$ultimo_dia_febrero) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_marzo=$this->getUltimoDiaMes($anio,$mar);
        
        
        $fecha_inicial_marzo=date("Y-m-d H:i:s", strtotime($anio."-".$mar."-".$primer_dia) );
        $fecha_final_marzo=date("Y-m-d H:i:s", strtotime($anio."-".$mar."-".$ultimo_dia_marzo) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_abril=$this->getUltimoDiaMes($anio,$ab);
        
        
        $fecha_inicial_abril=date("Y-m-d H:i:s", strtotime($anio."-".$ab."-".$primer_dia) );
        $fecha_final_abril=date("Y-m-d H:i:s", strtotime($anio."-".$ab."-".$ultimo_dia_abril) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_mayo=$this->getUltimoDiaMes($anio,$may);
    
        
        $fecha_inicial_mayo=date("Y-m-d H:i:s", strtotime($anio."-".$may."-".$primer_dia) );
        $fecha_final_mayo=date("Y-m-d H:i:s", strtotime($anio."-".$may."-".$ultimo_dia_mayo) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_junio=$this->getUltimoDiaMes($anio,$jun);
        
        
        $fecha_inicial_junio=date("Y-m-d H:i:s", strtotime($anio."-".$jun."-".$primer_dia) );
        $fecha_final_junio=date("Y-m-d H:i:s", strtotime($anio."-".$jun."-".$ultimo_dia_junio) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_julio=$this->getUltimoDiaMes($anio,$jul);
    
        
        $fecha_inicial_julio=date("Y-m-d H:i:s", strtotime($anio."-".$jul."-".$primer_dia) );
        $fecha_final_julio=date("Y-m-d H:i:s", strtotime($anio."-".$jul."-".$ultimo_dia_julio) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_agosto=$this->getUltimoDiaMes($anio,$ag);
        
        
        $fecha_inicial_agosto=date("Y-m-d H:i:s", strtotime($anio."-".$ag."-".$primer_dia) );
        $fecha_final_agosto=date("Y-m-d H:i:s", strtotime($anio."-".$ag."-".$ultimo_dia_agosto) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_septiembre=$this->getUltimoDiaMes($anio,$sep);
        
        
        $fecha_inicial_septiembre=date("Y-m-d H:i:s", strtotime($anio."-".$sep."-".$primer_dia) );
        $fecha_final_septiembre=date("Y-m-d H:i:s", strtotime($anio."-".$sep."-".$ultimo_dia_septiembre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_octubre=$this->getUltimoDiaMes($anio,$oct);
        
        
        $fecha_inicial_octubre=date("Y-m-d H:i:s", strtotime($anio."-".$oct."-".$primer_dia) );
        $fecha_final_octubre=date("Y-m-d H:i:s", strtotime($anio."-".$oct."-".$ultimo_dia_octubre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_noviembre=$this->getUltimoDiaMes($anio,$nov);
        
        
        $fecha_inicial_noviembre=date("Y-m-d H:i:s", strtotime($anio."-".$nov."-".$primer_dia) );
        $fecha_final_noviembre=date("Y-m-d H:i:s", strtotime($anio."-".$nov."-".$ultimo_dia_noviembre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_diciembre=$this->getUltimoDiaMes($anio,$dic);
        
        
        $fecha_inicial_diciembre=date("Y-m-d H:i:s", strtotime($anio."-".$dic."-".$primer_dia) );
        $fecha_final_diciembre=date("Y-m-d H:i:s", strtotime($anio."-".$dic."-".$ultimo_dia_diciembre) );
        


        
                //return view('listado.graficas2.create',["datos_ventas"=>$datos_ventas]);



        //////////////////////////       Sumatoria de ingreso y ventas por cada mes de año     /////////////////////////////////////////////////////////////////////////
        
        //////////////////////Enero ////////////////////////////////
        
        
        
  $enero_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_enero)
                ->where('i.fecha_hora','<=',$fecha_final_enero)
    			->paginate(1000);
        $enero_compra=0;
        foreach($enero_ingreso as $enero_ingresos){
            $enero_compra += $enero_ingresos->total;
        }   
  
        
////////////////////////////////////////////////////////
        
        
        
        $enero_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_enero,  $fecha_final_enero])->get();
        $ctenero=count($enero_venta);
        $enero=0;
        foreach($enero_venta as $enero_ventas){
            $enero += $enero_ventas->total_venta;
        }    
///////////////////////////// Febrero ///////////////////////////////////////       
    //$febrero_compra=4;

      
  $febrero_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_febrero)
                ->where('i.fecha_hora','<=',$fecha_final_febrero)
    			->paginate(1000);
        $febrero_compra=0;
        foreach($febrero_ingreso as $febrero_ingresos){
            $febrero_compra += $febrero_ingresos->total;
        }   
  



///////////////////////////////////////////////////////////////
$febrero_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_febrero,  $fecha_final_febrero])->get();
        $ctfebrero=count($febrero_venta);
        $febrero=0;
        foreach($febrero_venta as $febrero_ventas){
            $febrero += $febrero_ventas->total_venta;
        }
        
///////////////////////////// Marzo /////////////////////////////////////////        
         // $marzo_compra=6;
          
          
                  
  $marzo_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_marzo)
                ->where('i.fecha_hora','<=',$fecha_final_marzo)
    			->paginate(1000);
        $marzo_compra=0;
        foreach($marzo_ingreso as $marzo_ingresos){
            $marzo_compra += $marzo_ingresos->total;
        }   
  
          
          
          
/////////////////////////////////////////////////////////////////////////          
          
          $marzo_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_marzo,  $fecha_final_marzo])->get();
        $ctmarzo=count($marzo_venta);
        $marzo=0;
        foreach($marzo_venta as $marzo_ventas){
            $marzo += $marzo_ventas->total_venta;
        }
///////////////////////////// Abril /////////////////////////////////////////        
    //$abril_compra=8;


  
                  
  $abril_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_abril)
                ->where('i.fecha_hora','<=',$fecha_final_abril)
    			->paginate(1000);
        $abril_compra=0;
        foreach($abril_ingreso as $abril_ingresos){
            $abril_compra += $abril_ingresos->total;
        }   
  
          

        
////////////////////////////////////////////////////////////////////////////


          $abril_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_abril,  $fecha_final_abril])->get();
        $ctabril=count($abril_venta);
        $abril=0;
        foreach($abril_venta as $abril_ventas){
            $abril += $abril_ventas->total_venta;
        }
    
///////////////////////////// Mayo /////////////////////////////////////////        
        //$mayo_compra=10;
    
  $mayo_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_mayo)
                ->where('i.fecha_hora','<=',$fecha_final_mayo)
    			->paginate(1000);
        $mayo_compra=0;
        foreach($mayo_ingreso as $mayo_ingresos){
            $mayo_compra += $mayo_ingresos->total;
        }   
        
        
//////////////////////////////////////////////////////////////////////        
    
          $mayo_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_mayo,  $fecha_final_mayo])->get();
        $ctmayo=count($mayo_venta);
        $mayo=0;
        foreach($mayo_venta as $mayo_ventas){
            $mayo += $mayo_ventas->total_venta;
        }
    
///////////////////////////// Junio /////////////////////////////////////////        
 
  
  $junio_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_junio)
                ->where('i.fecha_hora','<=',$fecha_final_junio)
    			->paginate(1000);
        $junio_compra=0;
        foreach($junio_ingreso as $junio_ingresos){
            $junio_compra += $junio_ingresos->total;
        }   
  
  
  
  //////////////////////////////////////////////////
    
        $junio_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_junio,  $fecha_final_junio])->get();
        $ctjunio=count($junio_venta);
        $junio=0;
        foreach($junio_venta as $junio_ventas){
            $junio += $junio_ventas->total_venta;
        }    
///////////////////////////// Julio /////////////////////////////////////////       
        //$julio_compra=14;
        
        
    
  $julio_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_julio)
                ->where('i.fecha_hora','<=',$fecha_final_julio)
    			->paginate(1000);
        $julio_compra=0;
        foreach($julio_ingreso as $julio_ingresos){
            $julio_compra += $julio_ingresos->total;
        }    
        
////////////////////////////////////////////////////////////////////////////        

        $julio_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_julio,  $fecha_final_julio])->get();
        $ctjulio=count($julio_venta);
        $julio=0;
        foreach($julio_venta as $julio_ventas){
            $julio += $julio_ventas->total_venta;
        }           
            
///////////////////////////// Agosto /////////////////////////////////////////        
        //$agosto_compra=14;
        
        
        
    
  $agosto_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_agosto)
                ->where('i.fecha_hora','<=',$fecha_final_agosto)
    			->paginate(1000);
        $agosto_compra=0;
        foreach($agosto_ingreso as $agosto_ingresos){
            $agosto_compra += $agosto_ingresos->total;
        }    
        
/////////////////////////////////////////////////////
        
        
    
        $agosto_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_agosto,  $fecha_final_agosto])->get();
        $ctagosto=count($agosto_venta);
        $agosto=0;
        foreach($agosto_venta as $agosto_ventas){
            $agosto += $agosto_ventas->total_venta;
        } 
                 
///////////////////////////// Septiembre /////////////////////////////////////        
    
        //$septiembre_compra=16;
        
        
          $septiembre_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_septiembre)
                ->where('i.fecha_hora','<=',$fecha_final_septiembre)
    			->paginate(1000);
        $septiembre_compra=0;
        foreach($septiembre_ingreso as $septiembre_ingresos){
            $septiembre_compra += $septiembre_ingresos->total;
        }    
        
        
////////////////////////////////////////////////////////////////////////////        
        
        $septiembre_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_septiembre,  $fecha_final_septiembre])->get();
        $ctseptiembre=count($septiembre_venta);
        $septiembre=0;
        foreach($septiembre_venta as $septiembre_ventas){
            $septiembre += $septiembre_ventas->total_venta;
        } 
                                  
///////////////////////////// Octubre ///////////////////////////////////////        
        //$octubre_compra=18;
    
    
    
          $octubre_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_octubre)
                ->where('i.fecha_hora','<=',$fecha_final_octubre)
    			->paginate(1000);
        $octubre_compra=0;
        foreach($octubre_ingreso as $octubre_ingresos){
            $octubre_compra += $octubre_ingresos->total;
        }    
        
    
    
    
////////////////////////////////////////////////////////////////////////////    
        $octubre_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_octubre,  $fecha_final_octubre])->get();
        $ctoctubre=count($octubre_venta);
        $octubre=0;
        foreach($octubre_venta as $octubre_ventas){
            $octubre += $octubre_ventas->total_venta;
        } 
                                  
///////////////////////////// Noviembre /////////////////////////////////////// 

        //$noviembre_compra=20;   

          $noviembre_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_noviembre)
                ->where('i.fecha_hora','<=',$fecha_final_noviembre)
    			->paginate(1000);
        $noviembre_compra=0;
        foreach($noviembre_ingreso as $noviembre_ingresos){
            $noviembre_compra += $noviembre_ingresos->total;
        }    
        


/////////////////////////////////////////////////////////////////////////////
        $noviembre_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_noviembre,  $fecha_final_noviembre])->get();
        $ctnoviembre=count($noviembre_venta);
        $noviembre=0;
        foreach($noviembre_venta as $noviembre_ventas){
            $noviembre += $noviembre_ventas->total_venta;
        } 
                                
///////////////////////////// Diciembre ///////////////////////////////////////     
//$diciembre_compra=22;   

  
        $diciembre_ingreso=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_diciembre)
                ->where('i.fecha_hora','<=',$fecha_final_diciembre)
    			->paginate(1000);
        $diciembre_compra=0;
        foreach($diciembre_ingreso as $diciembre_ingresos){
            $diciembre_compra += $diciembre_ingresos->total;
        }    
    
  ///////////////////////////////////////////////////////////////////////////
  
        $diciembre_venta=Venta::whereBetween('fecha_hora', [$fecha_inicial_diciembre,  $fecha_final_diciembre])->get();
        $ctdiciembre=count($diciembre_venta);
        $diciembre=0;
        foreach($diciembre_venta as $diciembre_ventas){
            $diciembre += $diciembre_ventas->total_venta;
        }       
                                  
                                  
       
      ////////////////////////// Sumatoria de datos anuales/////////////////////////////////
      
      
                    /////////TOTAL INVERSIÓN ANUAL \\\\\\\\\
      
      
        $ingreso_anual=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','>=',$fecha_inicial_enero)
                ->where('i.fecha_hora','<=',$fecha_final_diciembre)
    			->paginate(1000);
        $total_compra=0;
        foreach($ingreso_anual as $ingreso_anuales){
            $total_compra += $ingreso_anuales->total;
        }    
    
    
                    //////////TOTAL DE VENTAS ANUAL  \\\\\\\\\\
                    
                    
        $venta_anual=Venta::whereBetween('fecha_hora', [$fecha_inicial_enero,  $fecha_final_diciembre])->get();
        $ctventa=count($venta_anual);
        $total_venta=0;
        foreach($venta_anual as $venta_anuales){
            $total_venta += $venta_anuales->total_venta;
        }       
    
                    
        
                    //////// TOTAL DE VENTAS POR DIA  \\\\\\\\\\\\\\\\  $fecha_actual=date("Y-m-d H:i:s", strtotime($anio_actual."-".$mes_actual."-".$dia_actual));
       
       
       
       /*
    			$venta_diaria=DB::table('venta as v')
    			->join('detalle_venta as dv','v.idventa','=','dv.idventa')
    			->select('v.idventa','v.fecha_hora','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
    			->where('v.fecha_hora','=',$fecha_actual)
    			->orderBy('v.idventa','desc')
    			->paginate(1000);
    	*/		
      
                //$venta_diaria=Venta::whereBetween('fecha_hora', [$fecha_actual,  $fecha_actual])->get();
          
          
                $venta_diaria=Venta::whereDate('fecha_hora', '=', Carbon::now()->format('Y-m-d'))->get();
          
                $ctventadia=count($venta_diaria);
                $total_venta_diaria=0;
                foreach($venta_diaria as $venta_diarias){
                $total_venta_diaria += $venta_diarias->total_venta;
        }
       //$total_venta_diaria=433;
       
                ////////// TOTAL DE INVERSIONES POR DIA \\\\\\\\\\\\\\\\\\\\\\\\\\\\
       




                
        $ingreso_diario=DB::table('ingreso as i')
    			->join('detalle_ingreso as di','i.idingreso','=','di.idingreso')
    			->select('i.idingreso','i.fecha_hora','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
    			->where('i.fecha_hora','=','2019-06-21 12:07:15')
    			->paginate(1000);
        $total_compra_diaria=0;
        foreach($ingreso_diario as $ingreso_diarios){
            $total_compra_diaria += $ingreso_diarios->total;
        }
       
       
       
            /////// Total de ganacias diarias \\\\\\\\\\\\\\\
            
            $marge_ganancia=0.3;
            $ganancia = $total_venta_diaria*$marge_ganancia;
            //$ganancia=25;
       
            /////// Total de ganacias anual \\\\\\\\\\\\\\\
       
                $ganancia_anual=$total_venta*$marge_ganancia;
       
                /////total de clientes \\\\\\\ 
       
       
       
      
    			$personas=DB::table('persona')
    			->where('tipo_persona','=','Cliente')
    			->where('tipo_persona','=','Cliente')
    			->orderBy('idpersona','desc')
    			->paginate(1000);
                $ctpe=count($personas);//cuenta todo los articulos existentes
        
        //////// % DE CUMPLIMENTO DE LA META \\\\\\\\
        
        $ventas_esperadas=($total_compra)+($total_compra*$marge_ganancia);
        if($ventas_esperadas!=0)
        $cumplimiento=(100*$total_venta)/$ventas_esperadas;
        else
        $cumplimiento=0;
        $cumplimiento_meta= $cumplimiento.'%';
        
        //$cumplimiento_meta=7;
        
       

        $data = array(0 => round($enero,1),
                      1 => round($febrero,1),
                      2 => round($marzo,1),
                      3 => round($abril,1),
                      4 => round($mayo,1),
                      5 => round($junio,1),
                      6 => round($julio,1),
                      7 => round($agosto,1),
                      8 => round($septiembre,1),
                      9 => round($octubre,1),
                      10 => round($noviembre,1),     
                      11 => round($diciembre,1),
                      12 => round($enero_compra,1),
                      13 => round($febrero_compra,1),
                      14 => round($marzo_compra,1),
                      15 => round($abril_compra,1),
                      16 => round($mayo_compra,1),
                      17 => round($junio_compra,1),
                      18 => round($julio_compra,1),
                      19 => round($agosto_compra,1),
                      20 => round($septiembre_compra,1),
                      21 => round($octubre_compra,1),
                      22 => round($noviembre_compra,1),     
                      23 => round($diciembre_compra,1 ),
                      24 => round($total_compra,1 ),
                      25 => round($total_venta,1 ),
                      26 => round($total_venta_diaria,1 ),
                      27 => round($total_compra_diaria,1 ),
                      28 => round($ctpe,1 ),
                      29 => round($ganancia,1 ),
                      30 => round($ganancia_anual,1 ),
                      31 => round($cumplimiento_meta,1 )
                    );
                    
        
                    
        
        echo  json_encode($data);
        
        //aqui cerro el comentario yoni
        
       // echo "[90, 80, 2, 4, 5, 6, 7,1, 2, 2, 70, 5, 6, 7]";
        
        //session_start();
        //$tendencia_mensual="[1, 2, 2, 4, 5, 6, 7,1, 2, 2, 4, 5,;
        //json_encode($data);
     //$_SESSION['tendencia_mensual']=$tendencia_mensual;
    
    
    
    }//aqui cierra el if de la grafica 1


////////////////////////////////////////////////// experimento /////////////

    if($condicion=='grafica3')
    {


        //$anio=$request->get('anio');
        
        //$anio=2019;
        $ene=1;
        $feb=2;
        $mar=3;
        $ab=4;
        $may=5;
        $jun=6;
        $jul=7;
        $ag=8;
        $sep=9;
        $oct=10;
        $nov=11;
        $dic=12;

// aqui comento yoni

        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_enero=$this->getUltimoDiaMes($anio,$ene);
        $primer_dia=1;
        
        $fecha_inicial_enero=date("Y-m-d H:i:s", strtotime($anio."-".$ene."-".$primer_dia) );
        $fecha_final_enero=date("Y-m-d H:i:s", strtotime($anio."-".$ene."-".$ultimo_dia_enero) );

        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_febrero=$this->getUltimoDiaMes($anio,$feb);
    
        
        $fecha_inicial_febrero=date("Y-m-d H:i:s", strtotime($anio."-".$feb."-".$primer_dia) );
        $fecha_final_febrero=date("Y-m-d H:i:s", strtotime($anio."-".$feb."-".$ultimo_dia_febrero) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_marzo=$this->getUltimoDiaMes($anio,$mar);
        
        
        $fecha_inicial_marzo=date("Y-m-d H:i:s", strtotime($anio."-".$mar."-".$primer_dia) );
        $fecha_final_marzo=date("Y-m-d H:i:s", strtotime($anio."-".$mar."-".$ultimo_dia_marzo) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_abril=$this->getUltimoDiaMes($anio,$ab);
        
        
        $fecha_inicial_abril=date("Y-m-d H:i:s", strtotime($anio."-".$ab."-".$primer_dia) );
        $fecha_final_abril=date("Y-m-d H:i:s", strtotime($anio."-".$ab."-".$ultimo_dia_abril) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_mayo=$this->getUltimoDiaMes($anio,$may);
    
        
        $fecha_inicial_mayo=date("Y-m-d H:i:s", strtotime($anio."-".$may."-".$primer_dia) );
        $fecha_final_mayo=date("Y-m-d H:i:s", strtotime($anio."-".$may."-".$ultimo_dia_mayo) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_junio=$this->getUltimoDiaMes($anio,$jun);
        
        
        $fecha_inicial_junio=date("Y-m-d H:i:s", strtotime($anio."-".$jun."-".$primer_dia) );
        $fecha_final_junio=date("Y-m-d H:i:s", strtotime($anio."-".$jun."-".$ultimo_dia_junio) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_julio=$this->getUltimoDiaMes($anio,$jul);
    
        
        $fecha_inicial_julio=date("Y-m-d H:i:s", strtotime($anio."-".$jul."-".$primer_dia) );
        $fecha_final_julio=date("Y-m-d H:i:s", strtotime($anio."-".$jul."-".$ultimo_dia_julio) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_agosto=$this->getUltimoDiaMes($anio,$ag);
        
        
        $fecha_inicial_agosto=date("Y-m-d H:i:s", strtotime($anio."-".$ag."-".$primer_dia) );
        $fecha_final_agosto=date("Y-m-d H:i:s", strtotime($anio."-".$ag."-".$ultimo_dia_agosto) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_septiembre=$this->getUltimoDiaMes($anio,$sep);
        
        
        $fecha_inicial_septiembre=date("Y-m-d H:i:s", strtotime($anio."-".$sep."-".$primer_dia) );
        $fecha_final_septiembre=date("Y-m-d H:i:s", strtotime($anio."-".$sep."-".$ultimo_dia_septiembre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_octubre=$this->getUltimoDiaMes($anio,$oct);
        
        
        $fecha_inicial_octubre=date("Y-m-d H:i:s", strtotime($anio."-".$oct."-".$primer_dia) );
        $fecha_final_octubre=date("Y-m-d H:i:s", strtotime($anio."-".$oct."-".$ultimo_dia_octubre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_noviembre=$this->getUltimoDiaMes($anio,$nov);
        
        
        $fecha_inicial_noviembre=date("Y-m-d H:i:s", strtotime($anio."-".$nov."-".$primer_dia) );
        $fecha_final_noviembre=date("Y-m-d H:i:s", strtotime($anio."-".$nov."-".$ultimo_dia_noviembre) );
        
        //calculo de de intervalos de fecha de cada mes para poder ser utilzada en las cosultas

        $ultimo_dia_diciembre=$this->getUltimoDiaMes($anio,$dic);
        
        
        $fecha_inicial_diciembre=date("Y-m-d H:i:s", strtotime($anio."-".$dic."-".$primer_dia) );
        $fecha_final_diciembre=date("Y-m-d H:i:s", strtotime($anio."-".$dic."-".$ultimo_dia_diciembre) );
        


        
                //return view('listado.graficas2.create',["datos_ventas"=>$datos_ventas]);


////////////////////////////////logica de negocio /////////////////////////////
        
    
        $articulos=articulo::all();//trae todo los articulos existentes, esto lo enviare como parametro, para que me indique en lps tipos de articulos en la grafica a mdodo de leyenda
        //$articulos=Articulo::whereBetween('fecha_hora', [$fecha_inicial_abril,  $fecha_final_abril])->get();
        
        $ctp=count($articulos);//cuenta todo los articulos existentes
        
        
       
        
        //este array va a aguardar todo los articulos en un vector con su respectivo id para saber cuales son los articulos que tengo resgitrado en mi bd
        
        $vector_colores[0]="#f56954";
        $vector_colores[1]="#00FF00";
        $vector_colores[2]="#FFFF00";
        $vector_colores[3]="#33CCCC";
        $vector_colores[4]="#00FFFF";
        $vector_colores[5]="#CCCCCC";
        $tam_colores=5;
        //continuar colores
        
        for($i=0;$i<=$ctp-1;$i++){
		
		 $total_ventas_por_articulo=1;
         $idA=$articulos[$i]->idarticulo;//(idarticulo es el pk de la tabla articulo)aqui obtengo el id de cada articulo de la tabla articulo
         $nombre_articulo=$articulos[$i]->nombre;
         $numerodearticulo[$idA]=0;//esto es un array que tiene por indice el id de cada articulo y de esa manera puedo saber que articulos tengo en mi base de datos
         ////////////////////////////test
        $ventas=DetalleVenta::all();//me traigo todas las ventas de la tabla detalles venta porq esta relacionada con el articulo
        $ct =count($ventas);//cuento todas las ventas
        
         for($j=0;$j<=$ct-1;$j++){
         $idA_segundo_ciclo=$ventas[$j]->idarticulo;//(idarticulo es clave kf en la tabla detallesventas)aqui relaciono ventas con articulo atravez de los pk (id), ahi va recorriendo las ventas y las ventas tienen un campo que se llama idarticulo
         if($idA_segundo_ciclo==$idA)
         $total_ventas_por_articulo++;
        }
        
        //Aqui me traere la talla relacionada a cada articulo
        
        
        
          $tallas=Talla::all();//me traigo todas las ventas de la tabla detalles venta porq esta relacionada con el articulo
        $ctt =count($tallas);//cuento todas las ventas
        
         for($z=0;$z<=$ctt-1;$z++){
         $idA_tercer_ciclo=$tallas[$z]->idtalla;//(idA_tercer_ciclo es clave  en la tabla articulo)aqui relaciono tallas con articulo atravez de los pk (idtalla), ahi se frena en un articulo y recorre la tabla talla con el id talla que viene de la tabla articulo y cuando cosigue esta talla, extraigo el nombre
         if($idA_tercer_ciclo==$idA)
         //$total_ventas_por_articulo++;
         $nombre_talla=$tallas[$z]->nombre;
        }
        
        
        ///////////////////// aqui termina el código para extraer las tallas por articulo\\\\\\\\\\\\\\
        
        
        if($i<=$tam_colores)
        $color_activo=$vector_colores[$i];
        else
        $color_activo="#f56954";
		$matriz[$i][0]=$total_ventas_por_articulo;
		$matriz[$i][1]=$color_activo;
		$matriz[$i][2]=$nombre_articulo." "."Talla"." ".$nombre_talla;
		////////////////////////////////
        }

        //aqui me va a contar todas las ventas que hay en el la bd relacionadas a un articulo, ct=ventas

       

        ///aqui envio todo los articulos que tengo y el numero de ventas de cada articulos, ctp=total de  articulos existentes, numerodearticulo = numero de ventas por cada tipo dearticulo, tipos= es un vector que contiene los distintos tipos de articulos

    $data=array("totaltipos"=>$ctp,"tipos"=>$articulos, "numerodepubli"=>$numerodearticulo);
        //return json_encode($data);//aqui envio por json todos estos valores a la interfaz (grafica)        
        
            
                           
         //  $peo=0;                       
          // $peo=25;

       
        
        $data = array(0 => round($ctp,1),
                      1 => round($ctp,1),
                      2 => round($ctp,1)
                    );
                    
        $data=$matriz;
                    
        
        echo  json_encode($data);
        
        //aqui cerro el comentario yoni
        
       // echo "[90, 80, 2, 4, 5, 6, 7,1, 2, 2, 70, 5, 6, 7]";
        
        //session_start();
        //$tendencia_mensual="[1, 2, 2, 4, 5, 6, 7,1, 2, 2, 4, 5,;
        //json_encode($data);
     //$_SESSION['tendencia_mensual']=$tendencia_mensual;
    
    
    
    }//aqui cierra el if de la grafica 3


            
        
        
    }//aqui cierra la funci贸n store
     
        
    }//aqui cierra la clase





    