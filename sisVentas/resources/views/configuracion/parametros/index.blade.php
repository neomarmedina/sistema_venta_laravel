
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
        <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-institution"></i> Gestionar Parametros de Configuracion</a></li>
        
        
      </ol>
    </section>


<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3> Gestionar Parametros de Configuracion </h3>
        @include('configuracion.parametros.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          <th>codigo</th>
                          <th>Nombre</th>
                          <th>Valor</th>
                          <th>Descripcion</th>
                           <th>Opciones</th>    
                     </thead>

                    @foreach ($parametros as $pm)
                      <tr>
                        <td>{{$pm->codigo}}</td>
                        <td>{{$pm->nombre}}</td>
                        <td>{{$pm->valor}}</td>
                        <td>{{$pm->descripcion}}</td>
                        <td>
                               <a href="{{URL::action('ParametrosController@edit',$pm->idparametro)}}"> <button class="btn btn-info">Editar</button></a>

                        </td>       
                      </tr>  

                      @endforeach

                </table>


          </div>

          {{$parametros->render()}}


     </div>

</div>


@endsection