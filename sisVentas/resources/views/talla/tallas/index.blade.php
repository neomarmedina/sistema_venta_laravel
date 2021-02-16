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
        <li><a href="#"><i class="fa fa-laptop"></i> Gestionar Tallas</a></li>
        
      </ol>


<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar de Tallas<a href="tallas/create">  <button class="btn btn-success">Registrar nueva Talla</button><a/></h3>
        @include('talla.tallas.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          
                          <th>Nombre</th>
                           <th>Descripcion</th>
                           <th>Opciones</th>    
                     </thead>

                    @foreach ($tallas as $tall)
                      <tr>
                        
                        <td>{{$tall->nombre}}</td>
                        <td>{{$tall->descripcion}}</td>
                        <td>
                               <a href="{{URL::action('TallaController@edit',$tall->idtalla)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$tall->idtalla}}" data-toggle=modal ><button class="btn btn-danger">Eliminar</button></a>
                        </td>       
                      </tr>  


                      @include('talla.tallas.modal')

                      @endforeach

                </table>


          </div>

          {{$tallas->render()}}


     </div>

</div>


@endsection