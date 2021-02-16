
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
        <li><a href="#"><i class="fa fa-shopping-cart"></i> Gestionar Ventas</a></li>
       
      </ol>
    </section>





<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar Ventas<a href="venta/create">  <button class="btn btn-success">Facturar Articulo</button><a/></h3>
        @include('ventas.venta.search')
    </div>

</div>


<div class="row">
  
     <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          
                          <th>Fecha</th>
                           <th>Cliente</th>
                           
                           <th>Vendedor</th>
                           <th>Tipo de Comprobante</th>
                           
                           <th>Total</th>
                           
                           <th>Estatus</th>
                           <th>Opciones</th>

                     </thead>
                     <?php
                      $var=0;
                      $fecha_legible=0;
                     ?>

                    @foreach ($ventas as $ven)
                      <tr>
                       
                      <?php
                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
                        $var = explode('-',$ven->fecha_hora);//(año-mes-dia asi viene de la bd)
      

                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

                      ?>



                        <td>{{$fecha_legible}}</td>
                        <td>{{$ven->nombre}}</td>
                        
                        <td>{{$ven->vendedor}}</td>

                        <td>

                        <?php  

                        if($ven->tipo_comprobante=='Factura')
                        {
                         ?> 
                       

                          {{'N°.Factura :'.$ven->serie_comprobante."-".'N°Control :'.$ven->num_comprobante}}

                        
                       
                         <?php
                           }
                         ?> 

                            <?php  

                        if($ven->tipo_comprobante=='Nota de Entrega')
                        {
                         ?> 
                       

                          {{'N°.Nota de Entrega :'.$ven->serie_comprobante."-".   'N°.Control :'.$ven->num_comprobante}}

                        
                         <?php
                           }
                         ?> 



                        </td>
               
                        
                        <td>{{$ven->total_venta}}</td>
                        
                        <td>

                         <?php 
                         //Aqui solo entrarán  las facturas con el estatus de : Por cobrar
                         if($ven->estatus_venta=='Por Cobrar')
                         {
                                $dia_actual_calculo=date("Y-m-d");// Loutilizo para comparar si ha pasado mas de 7 dias desde que se emitio la factura

                                //Aqui le digo que me pondran como estaus de vencida a las ventas que tengas mas de 7 dias con el esatatus = Por cobrar
                                if($dia_actual_calculo>=date("Y-m-d",strtotime($ven->fecha_hora."+ 7 days")))
                                {                                 
                          ?> 

                                      <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle=modal ><button class="btn btn-danger">{{'Vencida.....'}}</button></a>
                                  <?php
                                    }

                                    else
                                    {
                                    ?>

                                           <a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle=modal ><button class="btn btn-info">{{$ven->estatus_venta}}</button></a>


                         <?php          
                                     } 


                         }  
                        ?>    

                       
                        <?php
       
                         if($ven->estatus_venta=='Pagado')
                         {
                        ?>
                        <a href="" data-target="#modalestatus-delete-{{$ven->idventa}}"  data-toggle=modal ><button class="btn btn-success">{{$ven->estatus_venta."....."}}</button></a>
                        <?php
                        }
                        ?>
                        </td>
                        <td>
                               <a href="{{URL::action('VentaController@show',$ven->idventa)}}"> <button class="btn btn-primary">Ver</button></a>


                                <a href="{{URL::action('DevolucionController@edit',$ven->idventa)}}"> <button class="btn btn-warning"><i class="fa fa-edit"></i> Devoluc.</button></a></button></a>

                                <?php

                                if($ven->estado=='A')
                                 { 
                              ?>


                               <a href="" data-target="#modalanular-delete-{{$ven->idventa}}"  data-toggle=modal >
                                <button class="btn btn-default"><i class="fa fa-edit"></i> Anular...</button></a></button></a>

                                <?php

                                  }

                                if($ven->estado=='C')
                                 { 
                              ?>
                                  <a href="" data-target="#modalanulado-delete-{{$ven->idventa}}"  data-toggle=modal >
                                 <button class="btn btn-default"><i class="fa  fa-close"></i> Anulada</button></a></button></a>

                              <?php


                              }
                              ?>
                        </td>       
                      </tr>  


                      @include('ventas.venta.modaldevolucion')
                      @include('ventas.venta.modal')
                      @include('ventas.venta.modalestatus')
                      @include('ventas.venta.modalanular')
                      @include('ventas.venta.modalanulado')

                      @endforeach

                </table>


          </div>

          {{$ventas->render()}}


     </div>

</div>


@endsection