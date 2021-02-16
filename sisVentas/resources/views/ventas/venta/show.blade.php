@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        
        
        
      </ol>
    </section>

	<div class="row">
		
		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

					<label for="nombre">Tienda</label>
					
					<p>{{'RAZON SOCIAL :'.$venta->tienda}} </p>
					<p>{{'DIRECCIÓN : '.$venta->tienda_direccion}} </p>
					<p>{{'RIF. : '.$venta->tienda_rif}} </p>
					<p>{{'TELEFONO : '.$venta->tienda_tlf}} </p>


				</div>

		</div>


			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				

					<label for="nombre">Fecha de Venta</label>



                      	   <?php
                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
                        $var = explode('-',$venta->fecha_hora);//(año-mes-dia asi viene de la bd)
      

                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

                      ?>


					
					<p>{{$fecha_legible}} </p>

				</div>

		</div>
		
		
			<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				

					<label for="nombre">Cliente</label>
					
					<p>{{$venta->nombre." / ".$venta->tipo_documento." : "."$venta->num_documento"."tlf : "."$venta->telefono" }} </p>

				</div>

		</div>

			<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				

					<label for="nombre">Vendedor</label>
					
					<p>{{$venta->vendedor." / ".$venta->documento_vendedor." : "."$venta->cedula"." / "."tlf: "."$venta->telefono" }} </p>

				</div>

		</div>	

		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		
					<div class="form-group">

						<label for="tipo_documento">Tipo Comprobante</label>
							
						<p>{{$venta->tipo_comprobante}} </p>

						
					</div>

		</div>
		
		
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		

				<div class="form-group">
				
				 <?php  

                        if($venta->tipo_comprobante=='Factura')
                        {
                         ?> 
                       

									<label for="serie_comprobante">N° de Factura</label>

                       
						 <?php
                           }
                         ?> 			
							



							<?php  

                        if($venta->tipo_comprobante=='Nota de Entrega')
                        {
                         ?> 
                       

									<label for="serie_comprobante">N°.Nota de Entrega</label>

                       
						 <?php
                           }
                         ?> 		
									<p>{{$venta->serie_comprobante}} </p>								
				</div>


		</div>







		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_comprobante">N° de Control</label>
									
									<p>{{$venta->num_comprobante}} </p>							
				</div>


		</div>

			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		

				<div class="form-group">
				<section>
				     
				      <ol class="breadcrumb">
				        
				        

				         <a href="#" onclick="Redirect();"><i class="fa fa-download"></i>{{'Imprimir'.'-'.$venta->tipo_comprobante}}

				        <input type="hidden" id="idventa" value="{{$venta->idventa}}"> </input>
				        
				      </ol>
				    </section>

													
														
				</div>


		</div>
	
</div>
	
<div class="row">

	<div class="panel panel-primary">
				
			<div class="panel-body">
				
							
					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
							
							<thead style="background-color:#d8dee3">
							
							<th>Totales</th>
							<th>Código</th>
							<th>Descripción</th>
							<th>Cantidad</th>
							<th>Precio Unitario</th>
							<th>Descuento</th>
							<th>Precio Neto</th>

							</thead>
							
							<tbody>


							@foreach($iva as $iv)

								<?php
									$iva_gestionable=$iv->valor;
								?>
							
							@endforeach	


							<?php $baseimponente = 0; 
								$iva=0;
								$total_venta=0;
							?>
							@foreach($detalles as $det)

							<tr> 
								<td> </td>
								<td>{{$det->codigo}} </td>
								<td>{{$det->descripcion}} </td>
								<td>{{$det->cantidad}} </td>
								<td>{{$det->precio_venta}} </td>
								<td>{{$det->descuento}} </td>
								<td>{{$det->cantidad*$det->precio_venta-$det->descuento}} </td>
							</tr>
							
							<?php $baseimponente += ($det->cantidad)*($det->precio_venta-$det->descuento);
								


								if($venta->tipo_comprobante=='Factura')
								{

									$iva=($baseimponente*$iva_gestionable)/100;	
								}	

								if($venta->tipo_comprobante=='Nota de Entrega')
								{

									$iva=0;	
								}	



							  ?> 

							@endforeach
							</tbody>

							<tfoot>

							<td> </td>
							<th><h5 align="right"><b>BASE IMPONIBLE :</b></h4></th>
							<th>{{$baseimponente." "."Bs.S"}}</th>
							<th><h5 align="right"><b>IVA ({{$iva_gestionable."%"}}) :</b></h4></th>
							<th><?php echo $iva." "."Bs.S";   ?>  </th>
							<th><h5 align="right"><b>TOTAL A PAGAR :</b></h4></th>
							<th>
							
							
							<?php

								if($venta->tipo_comprobante=='Factura')
								{
									?>
									<h5 id="total"><b>{{$venta->total_venta." "."Bs.S"}}</b></h5></th>
									<?php

										
								}	

								if($venta->tipo_comprobante=='Nota de Entrega')
								{
									?>
									<h5 id="total"><b>{{$baseimponente." "."Bs.S"}}</b></h5></th>
									<?php

										
								}	

								?>


							
							</tfoot>
						</table>
					</div>
				</div>	
			</div>

</div>	



@push('scripts')


<script>



$(document).ready(function(){

	$('#bt_add').click(function(){

		Redirect();
	});
});




//En esta funcion la hago para enviar por el metodo Get el valor del idventa, o sea de la factura que el usuario quiere imprimir, la envio al controlador a la ruta pfd/factura y con el parametro {idventa}

function Redirect()
{

//alert('esta entrando');
	
		
	id=document.getElementById("idventa").value;// aqui obtengo el valor de idventa que le asigne al compo oculto (type=hidden), para poder enviarlo al contrlador por medio de la ruta
	
location.href = "../../pfd/factura/{id}?id="+id;// estoy enviando a un a ruta especifica ela valor de idventa
 	 
	

	//alert(idventa=document.getElementById("idventa").value);


  }



//voy a declarar. ojoo una funcion inicial que se va a ejecutar cuando entremos a este documento y hagamoa click en el boton buscar del la interfaz que tiene como id='bt_add'



</script>

	
@endpush		



@endsection