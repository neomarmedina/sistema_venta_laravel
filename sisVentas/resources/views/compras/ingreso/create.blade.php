@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('compras/ingreso')}}"><i class="fa fa-truck"></i> Gestionar Ingresos de Mercancía</a></li>
        <li><a> Abastecer almacen
        
      </ol>
    </section>

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Registrar Ingreso de Mercancía al Almacen</h3>

				
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


				{!! Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
						
				{{Form::token()	}}

	<div class="row">
		
		<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				

					<label for="nombre">Proveedor</label>
					
					<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
						
						<option value="">Seleccione...</option>

						@foreach ($personas as $persona)
							
						<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>

						@endforeach

					</select>	

				</div>

		</div>
		


		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		
					<div class="form-group">

						<label for="tipo_documento">Tipo Comprobante</label>
						

						<select name="tipo_comprobante" class="form-control">
					
							<option value="Factura">Factura</option>
							<option value="Nota de Entrega">Nota de Entrega</option>
								
						</select>
					</div>

		</div>
		
		

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		

				<div class="form-group">
				

									<label for="serie_comprobante">N°.Factura</label>
									<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie del Comprobante..."></input>								
				</div>




		</div>

		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_comprobante">N°.Control</label>
									<input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Número del Comprobante..."></input>								
				</div>




		</div>
	
</div>






	
<div class="row">

					<div class="panel panel-primary">
				
						<div class="panel-body">
				
							<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

								<div class="form-group">

									<label>Articulo</label>
									<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">

										<option value="">Seleccione...</option>
										@foreach($articulos as $articulo)

										<option value="{{$articulo->idarticulo}}">{{$articulo->nombre." ,"."Codigo = "." "."$articulo->codigo"." "."Talla =".$articulo->talla}}</option>	

										@endforeach
									</select>



								</div>


							</div>


							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


								<div class="form-group">

									<label for="cantidad">Cantidad</label>
									<input type="number" name="pcantidad" id="pcantidad" class="form-control"  placeholder="cantidad"></input>								
								</div>


							</div>

					


					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">


							<label for="precio_compra">P. Compra</label>
									<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control"  placeholder="P. Compra"></input>		

							</div>

					</div>

					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									<label for="precio_venta">P. Venta</label>
									<input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control"  placeholder="P Venta"></input>		


							</div>

					</div>


					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">


							<div class="form-group">

									<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>

							</div>

					</div>


					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">

						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
							
							<thead style="background-color:#A9D0F5">
							
							<th>Opciones</th>
							<th>Artículo</th>
							<th>Cantidad</th>
							<th>Precio Compra</th>
							<th>Precio Venta</th>
							<th>Sub Toltal</th>


							</thead>

							<tfoot>
							<th>TOTAL</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><h4 id="total">S/. 0.00</h4></th>


							
								

							</tfoot>

							<tbody>
								


							</tbody>



						</table>


					</div>





				</div>	
			

			</div>


				
					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
	

							<div class="form-group">
								
							<input name"_token" value="{{ csrf_token() }}" type="hidden"></input>

								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
							</div>
								

					</div>
								

	
	
</div>			

{!!Form::close()!!}
	

@push('scripts')


<script>
	
//voy a declarar. ojoooooooo una funcion inicial que se va a ejecutar cuando entremos a este documento
// cuando hagan click en el boton tbt : $(#bt_add).click(function(){ llamo a la funcion agregar : agregar();
$(document).ready(function(){

	$('#bt_add').click(function(){

		agregar();
	});
});


var cont=0;//lo utilzaremos como contador
total=0;// inicializamos en cero el valor del campo total de la tabla.
subtotal=[];// lo iniciamos en vacio, y lo utilizaremos para capturar todos los subtotales de cada una de las lineas de los detalles ( de la tala del formulario)
$("#guardar").hide();//aqui le digo que cuando cargue el documento, o se a el formulario, el boton guardar va a estar oculto.

//en esta funcion, inicialmente voy a leer todos los valores que tengo en mis objetos de formularios (campos) y guardarlo en unas variables respectivas, para luego agregarlos al la tabla detalles

function agregar(){

	idarticulo=$("#pidarticulo").val();
	articulo=$("#pidarticulo option:selected").text();// aqui no quiero  obtener el valor del select sino el texto que este selecionado
	cantidad=$("#pcantidad").val();
	precio_compra=$("#pprecio_compra").val();
	precio_venta=$("#pprecio_venta").val();

	
//con este condicional voy a validar que los campos que se guarden en la table detales no esten vacios
// tambien voy a declarar una variable fila : var fila='<tr class="select" id="fila+'cont+'"></tr>'; para agregar una fila a la tabla, el cual tendra un id que nos permitirá evaluar que fila quiero eliminar.
//y dentro del if voy a dibujar una tabla con input que llenare con los valores que recibo por medio de las variables de jquery de cada uno de los campos del del detalle.
	if(idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
	{

		subtotal[cont]=(cantidad*precio_compra);// este será un subtotal por cafa fila de la tabla
		total=total+subtotal[cont];//por cada detalle calculo un subtotal

		var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td><td>'+subtotal[cont]+'</td></tr>';
	
	cont++;//hago esto para que mi contador se vaya acumulando, todas las veces que yo vaya agregando la fila, y se actualiza por si voy agregar mas filas.
	
	limpiar();//despues que agrego todas las filas que quiero a la tabla, voy a llamar a mi funcion limpiar, para limpiar los campos de la tabla detalles, para dejar vacia las cajas y poder ingresar nuevos valores
	
	$("#total").html("S/. "+ total);//ubicate en campo con id=total. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	evaluar();// aqui llamo la función evaluar(que la creo mas abajo), para que me muestre los botones cuando tenga algun detalle (cuando haya información en la tabla) en la tabla, si no  hay información ni siquiera permitirá hacer  clic en el boton guardar.


	//ahora la fila que dibujamos arriba y la guardamos en la variale fila, vamos a proceder a incluirla en nuestra tabla cuyo id=detalles (la unica tabla que tenemos).

	$('#detalles').append(fila);

	}
	else
	{

		alert("Error al ingresar el detalle del ingreso, revise los datos del articulo");
	}


}


function limpiar(){


	//aqui estoy utilizando jquery para limpiar los campos del formulario create, una vez se giraden los datos del detalle en la bd

	$("#pcantidad").val("");//aqui ubico el campo en formulario con el id de pcantidad y lo limpio con esta cadena vacia ("")
	$("#pprecio_compra").val("");
	$("#pprecio_venta").val("");
	
}


// voy agregar una funcion que permitirá ocultar los botones de guardar cuando la tabla no tenga información, para evitar que se  guarde un ingreso sin detalles, y mostrar los botones cuando la tabla tenga detalles por guardar.


function evaluar()
{

	if (total>0)
	{
		$("#guardar").show();// si hay detalles el div guardar se va a visualizar con el meotodo show()

	}
	else
	{
		$("#guardar").hide();//si no tiene detalle se va a oculta con el metodo hide().

	}


}	

//aqui creo la funcion eliminar para utilizarla cada vez que necesitemos eliminar una fila.
//recibe un parametro que lo llama index
function eliminar(index){

	total=total-subtotal[index];//recalcula el total tomando en cuenta el subtotal con el indice :index, o sea menos el subtotal de la fila que se quiere eliminar.
	$("#total").html("S/. " + total);//el campo total muestro el simbolo de soles, menos el nuevo total que estoy calculando.
	$("#fila" + index).remove();// y aqui elminamos la fila seleccionada.

	evaluar();//aqui nuevamente evaluo si el campo total es mayor que cero, esto para saber si activamos el boton agregar o lo ocultamos


}


</script>

	
@endpush

@endsection