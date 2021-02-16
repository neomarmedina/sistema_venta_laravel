
<?php 

if(Auth::user()->tipoUsuario=='2'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /avisos/aviso" />

<?php

}
?>
@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('calcular_comisiones')}}"><i class="fa fa-institution"></i> Calcular Comisiones</a></li>
        
        
      </ol>
    </section>


<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3> Detalles de Comisión </h3> 
        
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          <th>Nro.</th>
                          <th>Vendedor</th>
                           <th>Cliente</th>     
                            <th>Fecha Emitida</th>
                            <th>Fecha Cancelada</th>
                           <th> Monto de Venta</th>
                           <th>Nro. de Factura</th>
                           <th>Comisión por venta</th>    
                     </thead>
                    
                    
                    <?php $i =

                    
                     0; ?>
                    

                    @foreach ($datos_ventas as $dv)
                    


                    <?php $i++ ?>
                   
                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$dv->vendedor}}</td>
                        <td>{{$dv->cliente}} </td>


                        <td>



                           <?php
                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
                        $var = explode('-',$dv->fecha_hora);//(año-mes-dia asi viene de la bd)
      

                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

                      ?>


                        {{$fecha_legible}}


                        </td>

                        <td>

                        <?php
                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
                        $var = explode('-',$dv->fecha_pagada);//(año-mes-dia asi viene de la bd)

                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

                      ?>



                        {{$fecha_legible}}


                        </td>





                        <td>{{$total[$i]=(($dv->precio_venta*$dv->cantidad)-$dv->descuento)." "."Bs.S"}}</td>
                        <td>{{$dv->serie_comprobante}}</td>
                        

                        <td>{{$total[$i]=(($dv->precio_venta*$dv->cantidad)-$dv->descuento)*($dv->comision/100)." "."Bs.S"}}</td>          
                        
                           
                     
                      <tr>
                     @endforeach
                        <td><b>Totales</b></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        
                        <td><b>
                            
                        
                            
                             
                                
                            
                            
                        </b></td>
                        
                        
                        
                        
                        
                        
                        <td><b>
                            
                            
                        
                            
                          
                                    
                            
                        </b></td>
                        
                         
                    
                        <td><b>
                            
                            <?php $sum = 0; ?>
                        @foreach ($datos_ventas as $dv)
                            
                            <?php $sum +=(($dv->precio_venta*$dv->cantidad)-$dv->descuento)*($dv->comision/100);  ?> 
                            
                        @endforeach       
                            
                        <?php echo $sum."  "."Bs.S" ;   ?>    
                            
                        </b>
                        </td>
                        
                        
                     </tr>   

                </table>


          </div>

         


     </div>

</div>


@endsection