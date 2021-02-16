
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
        <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-users"></i> Gestionar Usuarios</a></li>
        
        
      </ol>
    </section>



<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar Usuarios<a href="usuario/create">  <button class="btn btn-success">Registrar Usuario</button><a/></h3>
        @include('seguridad.usuario.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          
                          <th>Nombre</th>
                           <th>Email</th>
                           <th>Rol</th>
                           <th>Fecha Creado</th>
                           <th>Opciones</th>    
                     </thead>

                    @foreach ($usuarios as $usu)
                      <tr>
                        
                        <td>{{$usu->name}}</td>
                        <td>{{$usu->email}}</td>
                        <td><?php if($usu->tipoUsuario=='1') echo "Administrador"; if($usu->tipoUsuario=='2') echo "Vendedor"; ?></td>
                        <td>{{$usu->created_at}}</td>
                        <td>
                               <a href="{{URL::action('UsuarioController@edit',$usu->id)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$usu->id}}" data-toggle=modal ><button class="btn btn-danger">Eliminar</button></a>
                        </td>       
                      </tr>  


                      @include('seguridad.usuario.modal')

                      @endforeach

                </table>


          </div>

          {{$usuarios->render()}}


     </div>

</div>


@endsection