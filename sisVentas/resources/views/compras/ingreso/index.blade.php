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
        <li><a href="#"><i class="fa fa-truck"></i> Abastecer almacen</a></li>
        
        
      </ol>
    </section>




<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Abastecer almacen<a href="ingreso/create">  <button class="btn btn-success">Registrar Ingreso</button><a/></h3>
        @include('compras.ingreso.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          
                          <th>Fecha</th>
                           <th>Proveedor</th>
                           <th>Comprobante</th>
                        
                           <th>Impuesto</th>
                           <th>Total</th>
                           <th>Estado</th>
                           <th>Opciones</th>

                     </thead>


                    @foreach ($ingresos as $ing)
                      <tr>
                       
                        <td>{{$ing->fecha_hora}}</td>
                        <td>{{$ing->nombre}}</td>
                        <td>{{$ing->tipo_comprobante.': '.$ing->serie_comprobante.'-'.$ing->num_comprobante}}</td>
               
                        <td>{{$ing->impuesto}}</td>
                        <td>{{$ing->total}}</td>
                        <td>{{$ing->estado}}</td>
                        <td>
                               <a href="{{URL::action('IngresoController@show',$ing->idingreso)}}"> <button class="btn btn-primary">Detalles</button></a>
                              <a href="" data-target="#modal-delete-{{$ing->idingreso}}" data-toggle=modal ><button class="btn btn-danger">Alunar</button></a>
                        </td>       
                      </tr>  


                      @include('compras.ingreso.modal')

                      @endforeach

                </table>


          </div>

          {{$ingresos->render()}}


     </div>

</div>


@endsection