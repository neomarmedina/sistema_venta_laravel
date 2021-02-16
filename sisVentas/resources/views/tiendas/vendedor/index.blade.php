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
        <li><a href="#"><i class="fa fa-institution"></i> Gestionar Vendedor</a></li>
        
        
      </ol>
    </section>

<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Gestionar Vendedores<a href="vendedor/create">  <button class="btn btn-success">Registrar Vendedor</button><a/></h3>
        @include('tiendas.vendedor.search')
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table-striped table-bordered table-condensed table-hover" width="1070">
                  
                      <thead>
                        
                          
                          <th>Nombre</th>
                           <th>Tipo Doc.</th>
                           <th>Número Doc.</th>
                           <th>Telefono</th>
                           <th>Email</th>
                           <th>% de Comisión</th>
                           <th>Estado</th>
                           <th>Opciones</th>    
                     </thead>


                    @foreach ($vendedores as $vend)
                      <tr>
                        
                        <td>{{$vend->nombre}}</td>
                        <td>{{$vend->tipo_documento}}</td>
                        <td>{{$vend->num_documento}}</td>
                        <td>{{$vend->telefono}}</td>
                        <td>{{$vend->email}}</td>
                        <td>{{$vend->comision}}</td>
                        <td>{{$vend->tipo_vendedor}}</td>

                        <td>
                               <a href="{{URL::action('VendedorController@edit',$vend->idvendedor)}}"> <button class="btn btn-info">Editar</button></a>
                              <a href="" data-target="#modal-delete-{{$vend->idvendedor}}" data-toggle=modal ><button class="btn btn-danger">Inhabilitar </button></a>
                        </td>       
                      </tr>  


                      @include('tiendas.vendedor.modal')

                      @endforeach

                </table>


          </div>

          {{$vendedores->render()}}


     </div>

</div>


@endsection