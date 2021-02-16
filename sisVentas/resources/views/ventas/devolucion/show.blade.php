@extends ('layouts.admin')
@section ('contenido')


	<div class="row">
		
		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

					<h3 class="box-title">Nota de Crédito</h3>
					

				</div>

		</div>





			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				

					<label for="nombre">Fecha (Día-Mes-Año)</label>
						
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>


                      	   <?php
                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
                        $var = explode('-',$devolucion->fecha_devolucion);//(año-mes-dia asi viene de la bd)
      

                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

                      ?>


                      <input disabled="" name="fecha_inicio_iglesia" value="{{$fecha_legible}}" type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    



                    </div>


				</div>

				</div>
		

		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

						@foreach($detalle_nota_credito as $det)	

					<label for="nombre"> Tienda  :  {{$det->tienda}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	

						
                    @endforeach
					
					

				</div>

		</div>	




			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				

					<label for="nombre">Nota de Crédito N° {{$devolucion->iddevolucion}}</label>
						
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>


				</div>

		</div>
		

		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				


					@foreach($detalle_nota_credito as $det)	

					<label for="nombre"> Rubro : {{$det->rubro}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	


                    @endforeach

					
					
					

				</div>

		</div>	




			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				
					@foreach($detalle_nota_credito as $det)

					<label for="nombre"> Venta Asociada : {{$det->	tipo_comprobante." ".'N°'.$det->serie_comprobante}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	


                    @endforeach

				</div>

		</div>


		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

					@foreach($detalle_nota_credito as $det)	

					<label for="nombre"> Domicilio  :  {{$det->domicilio}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	


                    @endforeach
					
					

				</div>

		</div>	




			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				
					@foreach($detalle_nota_credito as $det)	

					<label for="nombre"> Cliente {{$det->cliente}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	

						
                    @endforeach

				</div>

		</div>
		

		<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

					
					
					

				</div>

		</div>	




			<div class="col-lg-3 col-sm-3 col-md-6 col-xs-3">
				
				<div class="form-group">
				
					@foreach($detalle_nota_credito as $det)	

					<label for="nombre"> Vendedor : {{$det->vendedor}}</label>
					<div class="input-group">
                      <div class="input-group-addon">
                        <i></i>
                      </div>
                      
                    </div>	

						
                    @endforeach

				</div>

		</div>
	

	<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

						<section>
				     
				      <ol class="breadcrumb">
				        
				      			
				        <a href="#" onclick="Redirect();"><i class="fa fa-download"></i>Imprimir

				        <input type="hidden" id="iddevolucion" value="{{$devolucion->iddevolucion}}"> </input>
				        
				      </ol>
				    </section>
					
					

				</div>

		</div>	


<div class="col-lg-8 col-sm-8 col-md-6 col-xs-8">
				
				<div class="form-group">
				

					
					
					

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
							
							<th>Precio Neto</th>
							<th>Observación</th>
							<th>Imagen</th>	
							</thead>
							
							<tbody>
								@foreach($parametros as $pm)
									<?php
										$iva_gestionable=$pm->valor;
									?>

								@endforeach



							<?php $baseimponente = 0;
								  $iva =0;		
							 ?>
							@foreach($detalle_devolucion as $det)

							<tr> 
								<td> </td>
								<td>{{$det->codigo}} </td>
								<td>{{$det->descripcion}} </td>
								<td>{{$det->cantidadnueva}} </td>
								<td>{{$det->precio_venta}} </td>

								
								<td>{{$det->cantidadnueva*$det->precio_venta}} </td>
								<td>
								
								 <textarea name="$observaciones" value"{{$det->observaciones}}"  class="form-control" rows="3" placeholder="{{$det->observaciones}}"></textarea>		
								 </td>

								 <td>
								 		<img src="{{asset('imagenes/articulos/'.$det->imagen)}}" alt="{{$det->articulo}}" height="100" width="100" class="img-thumbnail">
								 </td>	

							</tr>
							
							<?php $baseimponente += $det->precio_venta*$det->cantidadnueva;
								$iva=($baseimponente*$iva_gestionable)/100;
							  ?> 

							@endforeach
							</tbody>

							<tfoot>

							
							<th><h5 align="right"><b>BASE IMPONIBLE :</b></h4></th>
							<th>{{$baseimponente." "."Bs.S"}}</th>
							@foreach($parametros as $pm)

							

							<th><h5 align="right"><b>IVA({{$pm->valor."% :"}})</b></h4></th>
							<th><?php echo $iva." "."Bs.S";   ?>  </th>
							<th><h5 align="right"><b>TOTAL A DEVOLVER :</b></h4></th>
							<th><h5 id="total"><b>{{$det->total_devolucion." "."Bs.S"}}</b></h5></th>



							@endforeach
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




//En esta funcion la hago para enviar por el metodo Get el valor del idevolucion, o sea de la nota de credito que el usuario quiere imprimir, la envio al controlador a la ruta pfd/notacredito y con el parametro {iddevolucion}

function Redirect()
{

//alert('esta entrando');
	
		
	iddevolucion=document.getElementById("iddevolucion").value;// aqui obtengo el valor de iddevolucion que le asigne al compo oculto (type=hidden), para poder enviarlo al contrlador por medio de la ruta
	
location.href = "../../pfd/notacredito/{iddevolucion}?iddevolucion="+iddevolucion;// estoy enviando a un a ruta especifica ela valor de iddevolucion
 	 
	

	//alert(iddevolucion=document.getElementById("iddevolucion").value);


  }



//voy a declarar. ojoo una funcion inicial que se va a ejecutar cuando entremos a este documento y hagamoa click en el boton buscar del la interfaz que tiene como id='bt_add'



</script>

	
@endpush		

@endsection