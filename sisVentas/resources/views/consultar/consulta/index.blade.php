<?php 

if(Auth::user()->tipoUsuario=='1'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /avisos/aviso" />

<?php

}
?>
@extends ('layouts.admin')
@section ('contenido')

<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Consultar Articulos</h3>
        @include('consultar.consulta.search')
        
    </div>

</div>


<div class="row">
  
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          
          <div class="table-reponsive">
            
                <table class="table table-bordered table-striped" width="1070">
                  
                      <thead>
                        
                          <th>Id</th>
                          <th>Nombre</th>
                           <th>Código</th>
                           <th>Categoría</th>
                           <th>Marca</th>
                           <th>Modelo</th>
                           
                           <th>Talla</th>
                           <th>Stock</th>
                           <th>Imagen</th>
                           
                               
                     </thead>


                    @foreach ($articulos as $art)
                      <tr>
                        <td>{{$art->idarticulo}}</td>
                        <td>{{$art->nombre}}</td>
                        <td>{{$art->codigo}}</td>
                        <td>{{$art->categoria}}</td>
                        <td>{{$art->marca}}</td>
                        <td>{{$art->modelo}}</td>
                        
                        <td>{{$art->talla}}</td>
                        <td>{{$art->stock}}</td>
                        <td>

                        <img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100" width="100" class="img-thumbnail">

                        </td>
                            
                      </tr>  


                      

                      @endforeach

                </table>


          </div>

          {{$articulos->render()}}


     </div>

</div>


@endsection