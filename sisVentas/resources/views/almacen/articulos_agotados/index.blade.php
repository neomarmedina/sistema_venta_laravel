
<?php 

if(Auth::user()->tipoUsuario=='2'){

?>

<!! con la etiqueta meta estoy redireccionando al modulo de ventas  !!>
<meta http-equiv="refresh" content="0; /avisos/aviso"" />

<?php

}
?>




<?php 

if(Auth::user()->tipoUsuario=='1'){

?>



@extends ('layouts.admin')
@section ('contenido')


<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-laptop"></i> Gestionar Articulos</a></li>
        
        
      </ol>
    </section>

<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Articulos Agotados<a href="articulo/create">  
        
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
                           <th>Estado</th>
                           <th>Estado</th>    
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
                        <td>{{$art->estado}}</td>
                        

                        <td>
                               
                              <a href="" data-toggle=modal ><button class="btn btn-danger">Agotado...</button></a>
                        </td>       
                      </tr>  


                     

                      @endforeach

                </table>


          </div>

          {{$articulos->render()}}


     </div>

</div>


@endsection




<?php

}
?>



