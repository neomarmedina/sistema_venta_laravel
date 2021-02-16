
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
        <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-institution"></i> Gestionar Departamentos</a></li>
        
        
      </ol>
    </section>


<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3> Gestionar Departamentos<a href="categoria/create">  <button class="btn btn-success">Agregar Departamento</button><a/></h3>
        @include('almacen.categoria.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          <th>Id</th>
                          <th>Nombre</th>
                           <th>Descripcion</th>
                           <th>Opciones</th>    
                     </thead>

                    @foreach ($categorias as $cat)
                      <tr>
                        <td>{{$cat->idcategoria}}</td>
                        <td>{{$cat->nombre}}</td>
                        <td>{{$cat->descripcion}}</td>
                        <td>
                               <a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle=modal ><button class="btn btn-danger">Eliminar</button></a>
                        </td>       
                      </tr>  


                      @include('almacen.categoria.modal')

                      @endforeach

                </table>


          </div>

          {{$categorias->render()}}


     </div>

</div>


@endsection