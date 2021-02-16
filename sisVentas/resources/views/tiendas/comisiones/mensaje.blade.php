
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
     
      <ol class="breadcrumb">         <li><a href="{{url('/home')}}"><i class="fa
fa-dashboard"></i> Panel de control         <li><a href="calcular_comisiones"><i class="fa fa-
shopping-cart"></i> Comisones</a></li>
       
      </ol>
    </section>





<div class="row">
  
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3> Actualmente este vendedor no posee comisiones acumuladas...
    </div>



{!!Form::close()!!}
@endsection