<?php 

if(Auth::user()->tipoUsuario=='2'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /consulta" />

<?php

}
?>
@extends ('layouts.admin')
@section ('contenido')




<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="#"><i class="fa fa-th"></i> Gestionar Proveedor</a></li>
        
        
      </ol>
    </section>



<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar de Proveedores<a href="proveedor/create">  <button class="btn btn-success">Agregar Proveedor</button><a/></h3>
        @include('compras.proveedor.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          <th>Código</th>
                          <th>Nombre</th>
                           <th>Tipo Doc.</th>
                           <th>Número Doc.</th>
                           <th>Telefono</th>
                           <th>Email</th>
                           <th>Opciones</th>    
                     </thead>


                    @foreach ($personas as $per)
                      <tr>
                        <td>{{$per->codigo}}</td>
                        <td>{{$per->nombre}}</td>
                        <td>{{$per->tipo_documento}}</td>
                        <td>{{$per->num_documento}}</td>
                        <td>{{$per->telefono}}</td>
                        <td>{{$per->email}}</td>
                        <td>
                               <a href="{{URL::action('ProveedorController@edit',$per->idpersona)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle=modal ><button class="btn btn-danger">Eliminar</button></a>
                        </td>       
                      </tr>  


                      @include('compras.proveedor.modal')

                      @endforeach

                </table>


          </div>

          {{$personas->render()}}


     </div>

</div>


@endsection