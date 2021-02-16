@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-shopping-cart"></i> Gestionar Devolución</a></li>
        <li><a>Devoluciones de Ventas
        
      </ol>
    </section>

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Devoluciones de Ventas</h3>
				
						@if(count($errors)>0)

						<div class="alert alert-danger">
							<ul>
					

									@foreach ($errors->all() as $error)
					
											<li>{{$error}}</li>

									@endforeach

							</ul>

						</div>
						@endif
		</div>				 
    </div>

{!! Form::model($venta,['method'=>'PATCH','route'=>['ventas.devolucion.update',$venta->idventa]])!!}
						
{{Form::token()}}

	
<div class="row">

					<div class="panel panel-primary">
				
						<div class="panel-body">
				


					<div class="row">	

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Detalles de Venta</label>
					              
					              <div class="row">
					                 
					              </div>
					               

					               </div>
          

							</div>
		
					</div>								






						
						<div class="row">	

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->	
					                <div class="form-group">
					                  <label>Venta N°</label>
					              
					              <div class="row">
					                 <input disabled name="cantidadvieja" value="{{$venta->idventa}}" placeholder="Cant. devolver ...">
					                
					                 <input type="hidden" name="idventa" value="{{$venta->idventa}}" >
					                
					              </div>
					               

					               </div>
          

							</div>


							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Cliente</label>
					              
					              <div class="row">
					                  <input disabled name="cantidad" value="{{$venta->nombre}}" placeholder="Cant. devolver ...">
					                <input type="hidden" name="idcliente" value="{{$venta->idcliente}}" placeholder="Cant. devolver ...">	
					              </div>
					               

					               </div>
          

							</div>


							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Fecha de la Venta</label>
					              
					              <div class="row">




					              	<?php
				                        //Aqui simplemente estoy cambiado el formato de fecha que viene d ela bd a un formato mas legible
				                        $var = explode('-',$venta->fecha_hora);//(año-mes-dia asi viene de la bd)
				      

						                  $fecha_legible=$var[2]."-".$var[1]."-".$var[0];// fecha para mostar en el reporte (Año- Mes - Dia)

				                      ?>


					                 <input disabled  value="{{$fecha_legible}}" placeholder="Cant. devolver ...">


					                  <input type="hidden" name="fecha_hora" value="{{$venta->fecha_hora}}" placeholder="Cant. devolver ...">
					                




					              </div>
					               

					               </div>
          

							</div>
					</div>		



					@foreach($parametros as $pm)

					<?php
						$iva_gestionable=$pm->valor;
					?>


					@endforeach

						<?php $descuentoglobal = 0; 
						$baseimponente=0;
						?>		
                    @foreach ($detalles as $det)			
					<?php 
					
					$descuentoglobal += $det->descuento;
					
					$baseimponente += ($det->precio_venta-$det->descuento)*$det->cantidad;
					$iva=($baseimponente*$iva_gestionable)/100;
							 
					 ?> 

					 @endforeach
					






					<div class="row">

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Des. Global</label>
					              
					              <div class="row">
					                 <input disabled value="<?php echo $descuentoglobal ?>" placeholder="Cant. devolver ...">
					                
					              </div>
					               

					               </div>
          

							</div>




							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Usuario</label>
					              
					              <div class="row">
					                 <input disabled name="cantidad" value="Admin" placeholder="Cant. devolver ...">
					                
					              </div>
					               

					               </div>
          

							</div>



							
							@foreach($parametros as $pm)


							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Impuesto</label>
					              
					              <div class="row">
					                 <input disabled name="impuesto" value="{{"I.V.A-".$pm->valor.".00"."%"}}"  placeholder="Cant. devolver ...">

					                 <input type="hidden" name="num_comprobante" value="{{$pm->valor}}" id="iva_gestionable" readonly class="form-control" placeholder="N° de Control..."></input>
					                
					              </div>
					               

					               </div>
          					</div>

						</div>

						@endforeach


					<div class="row">	

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>SubTotal Neto</label>
					              
					              <div class="row">
					                 <input disabled value="<?php echo $baseimponente ?>" placeholder="Cant. devolver ...">
					                
					              </div>
					               

					               </div>
          

							</div>


				@foreach($parametros as $pm)			


					<div class="row">		

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Total Impuesto</label>
					              
					              <div class="row">
					                 <input disabled name="cantidad" value="{{($det->precio_venta*$det->cantidad)*$pm->valor/100}}" placeholder="Cant. devolver ...">
					                
					              </div>
					               

					               </div>
          

							</div>

				@endforeach

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Total Venta</label>
					              
					              <div class="row">
					                 <input name="total_venta_vieja" disabled  value="{{$venta->total_venta}}" >

					                 <input type="hidden" name="total_venta" id="total_venta" value="{{$venta->total_venta}}"  placeholder="Cant. devolver ...">
					                 
					              </div>
					               

					               </div>
          

							</div>


							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">

								 <!-- textarea -->
					                <div class="form-group">
					                  <label>Tipo Comprobante</label>
					              
					              <div class="row">
					                 <input name="total_venta_vieja" disabled  value="{{$venta->tipo_comprobante}}" id="tipo_comprobante" >

					                 
					                 
					              </div>
					               

					               </div>
          

							</div>




							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


								

							</div>

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


								<div class="form-group">
								<label>Tipo Devolución</label>

                        <select   class="form-control"  data-live-search="true" id="tipo_devolucion" name="tipo_devolucion" >
                                 
								
                        		<option value="Parcial">Parcial</option>';
								<option value="Total" >Total</option>';  
                                   
                                        
                                  

                                </select>

									
								</div>


							</div>


					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									


							</div>

					</div>

					


					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							
					</div>

					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							

					</div>


					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
							
							<thead style="background-color:#d8dee3">
							
							
							<th>codigo</th>
							<th>articulo</th>
							<th>Cant.</th>
							<th>Precio Unit</th>
							<th>Desc.</th>
							<th>Sub Toltal</th>
							<th>Cant. a devolver</th>
							<th>NuevoSub Toltal</th>
							<th>Observaciones</th>
							<th>Imagen </th>



							</thead>

						


					<?php $baseimponente = 0; 
					$descuentogloba =0;	
					$i_total =0;	
					?>		
                    @foreach ($detalles as $det)
                      <tr>
                        
                        <td>{{$det->codigo}}</td>
                        <td>{{$det->articulo}}</td>
                        <td>{{$det->cantidad}}
                        <input type="hidden"  name="cantidad[]" id="cantidad<?php echo $i_total; ?>" class="form-control"  placeholder="idarticulo" value="{{$det->cantidad}}">

                        </input>	


                        </td>
                        
                        <td>
                        
                        <input disabled type="number" name="pprecio_venta" id="pprecio_venta<?php echo $i_total; ?>" class="form-control"  placeholder="P Venta" value="{{$det->precio_venta}}"></input>	

                        	

                         <input  type="hidden" name="idarticulo[]" id="idarticulo<?php echo $i_total; ?>" class="form-control"  placeholder="idarticulo" value="{{$det->idarticulo}}">	

                        </input>
                          <input type="hidden" name="iddetalle_venta[]" id="iddetalle_venta<?php echo $i_total; ?>" class="form-control"  placeholder="iddetalleventa" value="{{$det->iddetalle_venta}}">

                        </input>

                        <input type="hidden" name="precio_venta[]" id="precio_venta<?php echo $i_total; ?>" class="form-control"  placeholder="P Venta" value="{{$det->precio_venta}}"></input>	

                        </td>

                        <td>
                        <input disabled name="pdescuento" id="pdescuento<?php echo $i_total; ?>" class="form-control"  placeholder="P Venta" value="{{$det->descuento}}"></input>	
                        <input type="hidden" name="descuento" id="descuento<?php echo $i_total; ?>" class="form-control"  placeholder="P Venta" value="{{$det->descuento}}"></input>		


                        </td>
                        <td >{{($det->cantidad*$det->precio_venta)-($det->descuento)}}</td>
                        <td>


                        

                           <input onchange="mostrarResultados(this.value);" type="float" id="pcantidadnueva<?php echo $i_total; ?>" name="pcantidadnueva" class="form-control"  placeholder="Cantidad a Devolver" ></input>     




                        </td>


                         <td>
                         
                        
                           <h4 id="pprecio_venta_nuevo<?php echo $i_total; ?>">Bs.S</h4>
                       
                        <input type="hidden" name="precio_venta_nuevo" id="precio_venta_nuevo<?php echo $i_total; ?>" class="form-control"  placeholder="P Venta"></input>		
						

						<input type="hidden" name="cantidadnueva[]" id="cantidadnueva<?php echo $i_total; ?>" class="form-control"  placeholder="Cantidad Nueva"></input>	
                         </td>


                           <td>
                         	
                         	<input name="observaciones[]" id="observaciones<?php echo $i_total; ?>" class="form-control"  placeholder="Observaciones 		"></input>	
                         </td>

                      	
                          <td>
                         	
                         	
                      
                      	<img src="{{asset('imagenes/articulos/'.$det->imagen)}}" alt="{{$det->articulo}}" height="100" width="100" class="img-thumbnail">

                      	</td>

                      </tr>  

						<tbody>
								
					<?php 
					$baseimponente += $det->precio_venta-$det->descuento;
					$descuentogloba += $det->precio_venta-$det->descuento;
					$iva=($baseimponente*16)/100;
					$i_total++;
					 ?> 
					@endforeach	
					<input type="hidden" name="total_pos_hidden" id="total_pos_hidden"  value="<?php echo $i_total;?> ">
					</tbody>
						
						<tfoot>
							<th><h5 align="right"><b>BASE IMPONIBLE:</b></h4></th>
							<th><h4 id="base">Bs.S 0.00</h4><input type="hidden" name="base_imponible" id="base_imponible"></th>
							<th><h5 align="right"><b>IVA({{$iva_gestionable."%"}}):</b></h4></th>
							<th><h4 id="iva">Bs.S 0.00</h4><input type="hidden" name="total_iva" id="total_iva"></input></th>
							
							<th><h5 align="right"><b>NUEVO TOTAL:</b></h4></th>
							
							<th><h4 id="total">Bs.S 0.00</h4><input type="hidden"  name="total_devolucion" id="total_devolucion"></input>

								
					                
							</th>	

							</tfoot>
						  
					</table>


					</div>





				</div>	




			</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	

							<div class="form-group">
								<button class="btn btn-primary" type="submit">Confirmar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
							</div>
								

				</div>								



{!!Form::close()!!}


@push('scripts')


<script>
	
//voy a declarar. ojoooooooo una funcion inicial que se va a ejecutar cuando entremos a este documento
// cuando hagan click en el boton tbt : $(#bt_add).click(function(){ llamo a la funcion agregar : agregar();
$(document).ready(function(){

	$('#bt_add').click(function(){
		
		//agregar();
	});
});

var cont=0;//lo utilzaremos como contador
total=0;// inicializamos en cero el valor del campo total de la tabla.
subtotal=[];//declaramos un array lo iniciamos en vacio, y lo utilizaremos para capturar todos los subtotales de cada una de las lineas de los detalles ( de la tala del formulario)

$("#guardar").hide();//aqui le digo que cuando cargue el documento, o se a el formulario, el boton guardar va a estar oculto.

$("#pcantidadnueva").change(mostrarResultados);//cada vez que el usuario seleccione un articulo diferente en el select, llamaremos a la funcion mostrar valores 

function mostrarResultados(pcantidadnueva)
{


  total_pos_hidden=document.getElementById("total_pos_hidden").value;//precio_venta_nuevo
   total=0; 
   for(i=0;i<=total_pos_hidden;i++)
   {



			   pcantidadnueva=document.getElementById("pcantidadnueva"+i).value;
			   cantidad=document.getElementById("cantidad"+i).value;

								   					


							if(parseFloat(pcantidadnueva)>parseFloat(cantidad))
							{
								alert("DEBE INGRESAR UNA CANTIDAD MENOR O IGUAL A LA CANTIDAD DE PRODUCTO DE LA VENTA");

							}
													
						else
						{	
							   pprecio_venta=document.getElementById("pprecio_venta"+i).value;// aqui obtengo el precio de venta por cada fila
							   iva_gestionable=$("#iva_gestionable").val();//aqui obtengo el valor del iva gestionable que viene de la base de datos igual hay que dividirlo entre 100 para poder obtener el iva real

							  

							   descuento=document.getElementById("pdescuento"+i).value;// aqui obtengo el precio de venta por cada fila
							   total_por_fila_=pcantidadnueva*pprecio_venta;//Aqui tengo el nuevo subtotal por cada fila

							   tipo_comprobante=$("#tipo_comprobante").val();//aqui obtengo el valor de la cantidad de articulos ingresado por el usuario

							   total=total+(total_por_fila_-descuento);// Aqui tengo el total sin iva.
							   //iva=(total*16)/100;
							   //alert(tipo_comprobante);

							   //arriba recibo el valor con javascrits del tipo_comprobante el cual me dice si se generá una factura o una nota de pago, en factura iva=16% y en nota d epago iva= 0%
							   iva=0;
							   				if(tipo_comprobante=="Nota de Pago")				
											{	
												//iva=0;
												iva=(total*iva_gestionable)/100;

											}	
											if(tipo_comprobante=="Factura")
											{	
												iva=(total*iva_gestionable)/100;	
												
											}

							   totalpagar=total+iva;//Total a pagar incluyendo el IVA

							   tipo_comprobante=$("#tipo_comprobante").val();//aqui obtengo el valor de la cantidad de articulos ingresado por el usuario
								


							   document.getElementById("pprecio_venta_nuevo"+i).innerHTML=total_por_fila_;// aqui asigno el subtotal a cada fila de la tabla dinamica en la etiqueta html (ojo solo es para mostrar, para enviar en el controlador debe estar en un formulario)
							   //alert(cantidadnueva);
							   	
								$("#precio_venta_nuevo"+i).val(total_por_fila_);//ubicate en campo con id=total. Y con la función val, cargame el input con el valor total, lo enviamos con un val() porq no es html sino input.




							   document.getElementById("base").innerHTML=total;// aqui asigno el  total sin IVA (Base imponente)al campo html con ij=base

							   $("#base_imponible").val(total);//ubicate en campo con id=base_imponible, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor


							   document.getElementById("total").innerHTML=totalpagar;// aqui asigno el  total sin IVA (Base imponente)al campo html con ij=base
							   
							   $("#total_devolucion").val(totalpagar);//ubicate en campo con id=base_imponible, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor



							   document.getElementById("iva").innerHTML=iva;// aqui asigno el  total del IVA al campo html con id=iva
							   
							   $("#total_iva").val(iva);//ubicate en campo con id=total_iva, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor para al controlador

							   $("#cantidadnueva"+i).val(pcantidadnueva);//ubicate en campo con id=total. Y con la función val, cargame el input con el valor total, lo enviamos con un val() porq no es html sino input. ojo en $("#cantidadnueva"+i) el "+i" es para  ubcarme en el input cantidadnueva de cada registro y en enviarle el valor del value ose del "val(cantidadnueva)"

					}		   
			  

   }
                                    
	//cantidadnueva=$("#cantidadnueva option:selected").text();// aqui no quiero  obtener el valor del select sino el texto que selecciono el  usuario en el

	///lo que esta dentro de este condicional practicamente no funciona



}//Aqui cierra la funcion

function evaluar()
{

	if (total>0)
	{
		$("#guardar").show();// si hay detalles el div guardar se va a visualizar con el método show()

	}
	else
	{
		$("#guardar").hide();//si no tiene detalle se va a oculta con el metodo hide().

	}


}		







	


</script>

	
@endpush



	
@endsection