
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
        <li><a href=" "></a>><i class="fa fa-shopping-cart"></i> Gestionar Devoluciones</a></li>
       
      </ol>
    </section>





<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Devoluciones de VENTAS<a href="venta/create">  <button class="btn btn-success">Facturar Articulo</button><a/></h3>
        @include('ventas.devolucion.search')
    </div>

</div>


<div class="row">
  
     <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          
                           <th>Fecha</th>
                           <th>Venta.Asoc.</th>
                           
                           <th>Total Dev (Bs.S)</th>
                           
                           <th>Tipo</th>
                           
                           
                           <th>Estatus</th>
                           <th>Opciones</th>

                     </thead>


                    @foreach ($devolucion as $dev)
                      <tr>
                       
                        <td>{{$dev->fecha_devolucion}}</td>
                        <td>{{$dev->serie_comprobante}}</td>
                        <td>{{$dev->total_devolucion}}</td>
                        <td>{{$dev->tipo_devolucion}}</td>
                        
                        
               
                        
                        
                        
                        <td>

                         <?php 
                         if($dev->estatus=='Pendiente')
                         {
                          ?> 
                        <a href="" data-target="#modal-delete-{{$dev->iddevolucion}}" data-toggle=modal ><button class="btn btn-danger">{{$dev->estatus}}</button></a>
                        <?php
                        } 
                         if($dev->estatus=='Ejecutada')
                         {
                        ?>
                        <a href="" data-target="#modalestatus-delete-{{$dev->iddevolucion}}"  data-toggle=modal ><button class="btn btn-success">{{$dev->estatus}}</button></a>
                        <?php
                        }
                        ?>
                        </td>
                        <td>
                               <a  href="{{URL::action('DevolucionController@show',$dev->iddevolucion)}}"> <button class="btn btn-primary">Nota-Crédito</button></a>

                               

                              
                        </td>       
                      </tr>  


                      @include('ventas.devolucion.modaldevolucion')
                      @include('ventas.devolucion.modal')
                      @include('ventas.devolucion.modalestatus')

                      @endforeach

                </table>


          </div>

          {{$devolucion->render()}}


     </div>

</div>


@endsection