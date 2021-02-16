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
        <li><a href="#"><i class="fa fa-pie-chart"></i> Tendencias</a></li>
        
        
      </ol>
    </section>






	<?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<div  class="row" >

<div class="col-md-6">
                  <label>Año</label>
                  <select class="form-control" id="anio_sel"  onchange="cambiar_fecha_grafica();">

                  <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                    <option value="2015" >2015</option>
                    <option value="2016" >2016</option>
                    <option value="2017" >2017</option>
                    <option value="2018">2018</option>
                    <option value="2019" >2019</option>
                  </select>

</div>


<div class="col-md-6">
                  <label>Mes</label>
                  <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                  <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>

</div>


</div>

<div  class="row" >

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									

							</div>

</div>

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									

							</div>

</div>

<br/>

<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									<button type="button" id="bt_add" class="btn btn-primary">Ver Tendencias en Fecha Actual</button>

							</div>

					</div>

<br/>



<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_barras">
		</div>

	    <div class="box-footer">
		</div>
	</div>
	
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_lineas">
		</div>

	    <div class="box-footer">
		</div>
	</div>


	<br/>
	<div class="box box-primary">
		<div class="box-header">
		</div>

		<div class="box-body" id="div_grafica_pie">
		</div>

	    <div class="box-footer">
		</div>
	</div>


</div>


@push('scripts')
<script>

//llamo las funciones al hacer clic en los botones definidos

$(document).ready(function(){

	$('#bt_add').click(function(){

		
		//cargar_grafica_barras();
		probando();
	});
});


function probando(){

cargar_grafica_barras(<?= $anio; ?>,<?= intval($mes); ?>);
cargar_grafica_lineas(<?= $anio; ?>,<?= intval($mes); ?>);
cargar_grafica_pie();



//   alert("osa figuera mirellaa segundo nombre abad");
}

//esta funcion le manda la fecha seleccionada por el usuario a la funcion   cargar_grafica_barras(anio_sel,mes_sel); y cargar_grafica_lineas(anio_sel,mes_sel);
 

</script>
@endpush

@endsection