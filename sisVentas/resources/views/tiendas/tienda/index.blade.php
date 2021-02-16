
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
        <li><a href="#"><i class="fa fa-institution"></i> Gestionar Tiendas</a></li>
        
      </ol>
    </section>





<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar Tiendas<a href="tienda/create">  <button class="btn btn-success">Registrar tienda</button><a/></h3>
        @include('tiendas.tienda.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          <th>codigo</th>
                          <th>Nombre</th>
                           <th>Descripcion</th>
                           <th>Rif.</th>
                           <th>Teléfono</th>
                           <th>Dirección</th>
                           <th>Opciones</th>    
                     </thead>

                    @foreach ($tiendas as $tiend)
                      <tr>
                        
                        <td>{{$tiend->codigo}}</td>
                        <td>{{$tiend->nombre}}</td>
                        <td>{{$tiend->descripcion}}</td>
                        <td>{{$tiend->rif}}</td>
                        <td>{{$tiend->telefono}}</td>
                        <td>{{$tiend->direccion}}</td>
                        <td>
                               <a href="{{URL::action('TiendaController@edit',$tiend->idtienda)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$tiend->idtienda}}" data-toggle=modal ><button class="btn btn-danger">Eliminar</button></a>
                        </td>       
                      </tr>  


                      @include('tiendas.tienda.modal')

                      @endforeach

                </table>


          </div>

          {{$tiendas->render()}}


     </div>

</div>


@endsection