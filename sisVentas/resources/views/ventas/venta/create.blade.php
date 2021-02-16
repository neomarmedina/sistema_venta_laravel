@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('ventas/venta')}}"><i class="fa fa-shopping-cart"></i> Gestionar Ventas</a></li>
        <li><a>Facturar Articulo
        
      </ol>
    </section>

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Facturar Articulo</h3>

				
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


				{!! Form::open(array('url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'))!!}
						
				{{Form::token()	}}

	<div class="row">
		
		<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				

					<label for="nombre">Tienda</label>
					
					<select name="idtienda" id="idtienda" class="form-control selectpicker" data-live-search="true">
						
						@foreach ($tiendas as $tienda)

							<option value="{{$tienda->idtienda}}">{{$tienda->nombre}}</option>

						@endforeach

					</select>	

				</div>

		</div>
		


		<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				
					<label for="nombre">Cliente</label>					
					<select name="idcliente" id="idcliente" class="form-control selectpicker" data-live-search="true">						
						@foreach ($personas as $persona)
							<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
						@endforeach

					</select>	
				</div>
		</div>
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">


							<div class="form-group">


										<a href="#" onclick="Redirect();">Registrar Cliente</a></li>

							</div>

					</div>

		<div class="col-lg-12 col-sm-12 col-md-6 col-xs-12">
				
				<div class="form-group">
				

					<label for="nombre">Vendedor</label>
					
					<select name="idvendedor" id="idvendedor" class="form-control selectpicker" data-live-search="true">
						
						@foreach ($vendedores as $vendedor)

							<option value="{{$vendedor->idvendedor}}">{{$vendedor->nombre}}</option>

						@endforeach

					</select>	

				</div>

		</div>
		

		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		
					<div class="form-group">

						<label for="estatus_venta">Estatus de ventas</label>
						

						<select name="estatus_venta" class="form-control">
					
									
							<option value="Por Cobrar">Factura por Cobrar</option>
							<option value="Pagado">Factura Pagada</option>
							
								
						</select>
					</div>

		</div>



		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		
					<div class="form-group">

						<label for="tipo_comprobante" >Tipo Comprobante</label>
						

						<select onchange="GestionarIva(this.value);" id="tipo_comprobante" name="tipo_comprobante" class="form-control">
					
									
							<option value="1">Nota de Entrega</option>
							<option value="2">Factura</option>
							

								
						</select>
					</div>

		</div>
		
		

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12" id='div_campos_numero_factura'>
		

				<div class="form-group" >
				

				<label for="serie_comprobante" id="serie_comprobante_etiqueta">N° de nota de entrega</label>
				<input type="text" name="serie_comprobante" id="serie_comprobante" value="{{$serie_comprobante_total_N}}"  readonly class="form-control" placeholder="N° de Factura..."></input>	
										
				</div>

		</div>
		
		 <input type="hidden" name="serie_comprobante_hidden" id="serie_comprobante_hidden" value="{{$serie_comprobante_total}}"></input>
	     <input type="hidden" name="num_comprobante_total_hidden" id="num_comprobante_total_hidden" value="{{$num_comprobante_total}}"></input>
		 
		 <input type="hidden" name="serie_comprobante_total_N_hidden" id="serie_comprobante_total_N_hidden" value="{{$serie_comprobante_total_N}}"></input>
		 <input type="hidden" name="num_comprobante_total_N_hidden" id="num_comprobante_total_N_hidden" value="{{$num_comprobante_total_N}}"></input>
		 
		  
		  
		  

		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_comprobante">N° de Control</label>
									<input type="text" name="num_comprobante" id="num_comprobante" value="{{$num_comprobante_total_N}}" readonly class="form-control" placeholder="N° de Control..."></input>								
				</div>


		</div>


			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
		
				<div class="form-group">
				

									<label for="num_comprobante">Impuesto</label>
								
										@foreach($iva as $iv)

					                  <div class="col-sm-offset-2 col-sm-10">
					                    <div class="checkbox">
					                      
					                        <input disabled type="checkbox" checked> {{$iv->valor."%"}}
					                        <input type="hidden" name="iva_comprobante" value="{{$iv->valor}}" id="iva_gestionable" readonly class="form-control" placeholder="N° de Control..."></input>
					                      
					                    </div>
					                  </div>
					                     @endforeach

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

									<option value="">Seleccione... </option>
										@foreach($articulos as $articulo)

										<option value="{{$articulo->idarticulo}}_{{$articulo->stock}}_{{$articulo->precio_promedio}}">{{$articulo->articulo." ,"."Talla =".$articulo->talla}}</option>	




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

									<label for="stock">Stock</label>
									<input type="number" disabled name="pstock" id="pstock" class="form-control"  placeholder="Stock"></input>								
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


							<label for="descuento">% de Descuento</label>
									<input type="number" name="pdescuento" id="pdescuento" class="form-control" value="0"  placeholder="% de Descuento..."></input>		

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
							<th>Precio Venta</th>
							<th>% de Descuento</th>
							<th>Sub Toltal</th>


							</thead>

							<tfoot>
							<th><h5 align="right"><b>BASE IMPONIBLE :</b></h4></th>
							<th><h4 id="base">Bs.S 0.00</h4><input type="hidden" name="base_imponible" id="base_imponible"></th>

							@foreach($iva as $iv)
							<th><h5 align="right"><b>IVA ({{$iv->valor."%"}}) :</b></h4></th>
							@endforeach	


							<th><h4 id="iva">Bs.S 0.00</h4><input type="hidden" name="total_iva" id="total_iva"></input></th>
							
							<th><h5 align="right"><b>TOTAL A PAGAR :</b></h4></th>
							
							<th><h4 id="total">Bs.S 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></input></th>
								

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

								<button class="btn btn-primary" type="submit">Facturar</button>
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

$("#pidarticulo").change(mostrarValores);//cada vez que el usuario seleccione un articulo diferente en el select, llamaremos a la funcion mostrar valores 

//Esta función nos permitirá mostrar los valores que tengo conacatenados en mi select ariticulos(valores de articulos), mostra el precio de venta en el campo venta, y el stock del articulo en el campo stock 

function mostrarValores()
{
	// declaro la variable datosArticulos y (utilizando codigo javascripts) le digo que seleccione el campo con el id = pidarticulo, y cargo esa variable con los valores que estan en el campo id= pdiarticulo  separados por split ('_'). o sea en esta función lo que hago es separar los valores que habia recibidio en el campo idarticulo de manera concatenada por el metodo split  por guion bajos _  para luego asignarle esos valores a otros input de solo lectura(precio_venta y stock de el articulo seleccionado)

	datosArticulos=document.getElementById('pidarticulo').value.split('_');
	
	$("#pprecio_venta").val(datosArticulos[2]);//aqui le digo que el input  con el id = #pprecio_venta va a tomar el valor de datosArticulos en la posicion 2 osea precio de venta, o sea estoy pasandole al valor a ese input de precio de venta del articulo que a su vez vendría siendo precio promedio en la consulta del controlador
	$("#pstock").val(datosArticulos[1]);////aqui le digo que el input  con el id = #stock va a tomar el valor de la variable datosArticulos en la posicion 1 osea el stock del articulo seleccionado por el usuario, o sea estoy pasandole al valor a ese input de id=pstock  del articulo.


}





//en esta funcion, inicialmente voy a leer todos los valores que tengo en mis objetos de formularios (campos) y guardarlo en unas variables respectivas, para luego agregarlos al la tabla detalles de compra que voy a dibujar con jquery en mi interfaz, tantas filas como el usuario agrege, o sea una fila por articulo seleccionado

function agregar(){

//esta lineas de codigo la utilizo para extraer el id del articulo de los valores concatenados que se reciben en el select de articulo.

datosArticulos=document.getElementById('pidarticulo').value.split('_');
	
	


	idarticulo=datosArticulos[0];//Aqui le estoy asignado el id del articulo que seleccionó el usuario en el select de articulo en este fornulario de registro de venta.
	articulo=$("#pidarticulo option:selected").text();// aqui no quiero  obtener el valor del select sino el texto que selecciono el  usuario en el select del articulo.
	cantidad=$("#pcantidad").val();//aqui obtengo el valor de la cantidad de articulos ingresado por el usuario
	descuento=$("#pdescuento").val();//aqui obtengo el valor del descuento de articulos ingresado por el usuario
	precio_venta=$("#pprecio_venta").val();//igual
	stock=$("#pstock").val();//igual
	
	tipo_comprobante=$("#tipo_comprobante").val();//aqui obtengo el valor de la cantidad de articulos ingresado por el usuario
	
	iva_gestionable=$("#iva_gestionable").val();//aqui obtengo el valor del iva gestionable que viene de la base de datos igual hay que dividirlo entre 100 para poder obtener el iva real

	
//con este condicional voy a validar que los campos que se guarden en la table detales no esten vacios
// tambien voy a declarar una variable fila : var fila='<tr class="select" id="fila+'cont+'"></tr>'; para agregar una fila a la tabla, el cual tendra un id que nos permitirá evaluar que fila quiero eliminar.
//y dentro del if voy a dibujar una tabla con input que llenare con los valores que recibo por medio de las variables de jquery de cada uno de los campos del del detalle.
	if(idarticulo!="" && cantidad!="" && cantidad>0 && descuento!="" && precio_venta!="")
	{

		if(parseFloat(stock)>=parseFloat(cantidad))
		{

		descuento=(precio_venta*cantidad)*(descuento)/100;

		subtotal[cont]=(cantidad*precio_venta-descuento);// este será un subtotal por cada fila de la tabla
		total=total+subtotal[cont];//por cada detalle calculo un subtotal

				//arriba recibo el valor con javascrits del tipo_comprobante el cual me dice si se generá una factura o una nota de pago, en factura iva=16% y en nota d epago iva= 0%
				
				//alert(tipo_comprobante);
				if(tipo_comprobante=='1')				
				{	
					//iva=0;
					iva=(total*iva_gestionable)/100;	
				}	
				if(tipo_comprobante=='2')
				{	
					iva=(total*iva_gestionable)/100;	
					
				}

				totalpagar=total+iva;//Total a pagar incluyendo el IVA

		var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input readonly type="number" name="cantidad[]"  value="'+cantidad+'"></td><td><input type="number"  name="precio_venta[]" readonly value="'+precio_venta+'"></td><td><input type="number"  name="descuento[]" readonly value="'+descuento+'"></td><td>'+subtotal[cont]+'</td></tr>';
	
	cont++;//hago esto para que mi contador se vaya acumulando, todas las veces que yo vaya agregando la fila, y se actualiza por si voy agregar mas filas.
	
	limpiar();//despues que agrego todas las filas que quiero a la tabla, voy a llamar a mi funcion limpiar, para limpiar los campos de la tabla detalles, para dejar vacia las cajas y poder ingresar nuevos valores
	
	$("#total").html("Bs.S. "+ totalpagar);//ubicate en campo con id=total. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#total_venta").val(totalpagar);//ubicate en campo con id=total. Y con la función val, cargame el input con el valor total, lo enviamos con un val() porq no es html sino input.


	$("#iva").html("Bs.S. "+ iva);//ubicate en campo con id=total. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#total_iva").val(iva);//ubicate en campo con id=total_iva, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor


	$("#base").html("Bs.S. "+ total);//ubicate en campo de html con id=base. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#base_imponible").val(total);//ubicate en campo con id=base_imponible, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor



	evaluar();// aqui llamo la función evaluar(que la creo mas abajo), para que me muestre los botones cuando tenga algun detalle (cuando haya información en la tabla) en la tabla, si no  hay información ni siquiera permitirá hacer  clic en el boton guardar.


	//ahora la fila que dibujamos arriba y la guardamos en la variale fila, vamos a proceder a incluirla en nuestra tabla cuyo id=detalles (la unica tabla que tenemos).

	$('#detalles').append(fila);



		}
		else
		{

			alert("...............La cantidad a vender supera el Stock..............");

		}



		
	}
	else
	{

		alert("Error al ingresar el detalle de la venta, revise los datos del articulo");
	}


}


function limpiar(){


	//aqui estoy utilizando jquery para limpiar los campos del formulario create, una vez se giraden los datos del detalle en la bd

	$("#pcantidad").val("");//aqui ubico el campo en formulario con el id de pcantidad y lo limpio con esta cadena vacia ("")
	$("#pdescuento").val("");
	$("#pprecio_venta").val("");
	
}


// voy agregar una funcion que permitirá ocultar los botones de guardar cuando la tabla no tenga información, para evitar que se  guarde un ingreso sin detalles, y mostrar los botones cuando la tabla tenga detalles por guardar.


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

//aqui creo la funcion eliminar para utilizarla cada vez que necesitemos eliminar una fila.
//recibe un parametro que lo llama index
function eliminar(index){

	//////////////////////////////// Este es el ejemplo original
/*
	total=total-subtotal[index];//recalcula el total tomando en cuenta el subtotal con el indice :index, o sea menos el subtotal de la fila que se quiere eliminar.
	$("#total").html("S/. " + total);//el campo total muestro el simbolo de soles, menos el nuevo total que estoy calculando.
	$("#total_venta").val(total);//utilizo el val() porq es un input y no html
	$("#fila" + index).remove();// y aqui elminamos la fila seleccionada.
*/
//////////////Aqui recalculo el total a pagar sin iva o sea la base imponible///////////////////////////


	total=total-subtotal[index];//recalcula el total tomando en cuenta el subtotal con el indice :index, o sea menos el subtotal de la fila que se quiere eliminar.
	$("#base").html("Bs.S " + total);//el campo total muestro el simbolo de soles, menos el nuevo total que estoy calculando.
	$("#base_imponible").val(total);//utilizo el val() porq es un input y no html
	$("#fila" + index).remove();// y aqui elminamos la fila seleccionada.


	tipo_comprobante=$("#tipo_comprobante").val();//aqui obtengo el valor del tipo de comprobante, si es factura o es nota de entrega, si es Nota de entrega (o sea 1) eliva sera iva=0


	iva_gestionable=$("#iva_gestionable").val();//aqui obtengo el valor del iva gestionable que viene de la base de datos igual hay que dividirlo entre 100 para poder obtener el iva real


//////////////Aqui recalculo el total a pagar con IVA////////////////////////////////

//arriba recibo el valor con javascrits del tipo_comprobante el cual me dice si se generá una factura o una nota de pago, en factura iva=16% y en nota d epago iva= 0%
				
				//alert(tipo_comprobante);
				if(tipo_comprobante=='1')				
				{	
					//ivadesubtotal=0;//Aqui calculo el iva solo de la fila a eliminar (en este caso se llama subtotal)
					ivadesubtotal=(subtotal[index]*iva_gestionable)/100;//Aqui calculo el iva solo de la fila a eliminar (en este caso se llama subtotal)	
					
				}	
				if(tipo_comprobante=='2')
				{	
					ivadesubtotal=(subtotal[index]*iva_gestionable)/100;//Aqui calculo el iva solo de la fila a eliminar (en este caso se llama subtotal)	
					
				}	
	

	totalpagar=(totalpagar-subtotal[index])-ivadesubtotal;//recalcula el total a pagar con IVA tomando en cuenta el subtotal con el indice :index, o sea menos el subtotal de la fila que se quiere eliminar, y le resto el iva exacto de la fila a eliminar ya que anteriormente se le habia sumado ese subtotal mas su respectivo IVA
	$("#total").html("Bs.S " + totalpagar);//el campo total muestro el simbolo de soles, menos el nuevo total que estoy calculando.
	$("#total_venta").val(totalpagar);//utilizo el val() porq es un input y no html
	$("#fila" + index).remove();// y aqui eliminamos la fila seleccionada.


//////////////Aqui recalculo el IVA del total de toda la factura (De la base imponible)////////////////////////////////

	//total=total-subtotal[index];//recalcula el total tomando en cuenta el subtotal con el indice :index, o sea menos el subtotal de la fila que se quiere eliminar.
iva=(total*iva_gestionable)/100;
	$("#iva").html("Bs.S " + iva);//en el campo iva muestro el simbolo de Bs.S, menos el nuevo iva que estoy calculando.
	$("#total_iva").val(iva);//utilizo el val() porq es un input y no html
	$("#fila" + index).remove();// y aqui elminamos la fila seleccionada.





	evaluar();//aqui nuevamente evaluo si el campo total es mayor que cero, esto para saber si activamos el boton agregar o lo ocultamos


}

//Esta función pertenece al archivo modalcliente, de registro de persona(El cual nunca se implementó, se peude eliminar y no afecta el resto del codigo)

function test_llamado(){
//alert('interfaz evento ');

 $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
 nombre=document.getElementById("nombre").value;
 direccion=document.getElementById("direccion").value;
 tipo_documento=document.getElementById("tipo_documento").value;
 num_documento=document.getElementById("num_documento").value;
 telefono=document.getElementById("telefono").value
 ;
 email=document.getElementById("email").value
 ;


$.ajax({
                        type: 'GET',
                        url: "{{ url('ventas/cliente') }}",
                        data: 'nombre='+nombre+'direccion='+direccion+'tipo_documento='+tipo_documento+'num_documento='+num_documento+'telefono='+telefono+'email='+email,
                        dataType: 'JSON', 
                        success:function(response){
                           
                        }
                    });

 }



function Redirect()
{

//alert('esta entrando');

 //location.href = "../cliente/create";
 location.href = "../../cliente"; 


  }



// Esta función la estoy usando para habilitar o inhabilitar el IVA dependiendo si el tipo de comprobante es una Factura o Nota de entrega; sin embargo el la funcion mostrar tambien se hace este proceso pero en este caso se garantiza de que si el usuario se le olvidó seleccionar el tipo de comprobante y se regresa a cambiarlo entonces se puede modificar tanto el valor de iva como el total a pagar


function GestionarIva(tipo_comprobante){
 
////////////////activar/desactivar campos numero de factura Email
//1 nota de entrega
//2 factura
 serie_comprobante_hidden=$("#serie_comprobante_hidden").val();
 num_comprobante_total_hidden=$("#num_comprobante_total_hidden").val();

 serie_comprobante_N_hidden=$("#serie_comprobante_total_N_hidden").val();
 num_comprobante_total_N_hidden=$("#num_comprobante_total_N_hidden").val(); 
 
 

if(tipo_comprobante=="1"){
     
      $("#serie_comprobante_etiqueta").text("N° de nota de entrega");
     $("#serie_comprobante").val(serie_comprobante_N_hidden);
     $("#num_comprobante").val(num_comprobante_total_N_hidden);
    
}
if(tipo_comprobante=="2"){
    
     $("#serie_comprobante_etiqueta").text("N° de Factura");
    $("#serie_comprobante").val(serie_comprobante_hidden);
     $("#num_comprobante").val(num_comprobante_total_hidden);
    
}

//////////////////////////////////////////////////////////Email 


//esta lineas de codigo la utilizo para extraer el id del articulo de los valores concatenados que se reciben en el select de articulo.

datosArticulos=document.getElementById('pidarticulo').value.split('_');
	
	
	cantidad=$("#pcantidad").val();//aqui obtengo el valor de la cantidad de articulos ingresado por el usuario
	descuento=$("#pdescuento").val();//aqui obtengo el valor del descuento de articulos ingresado por el usuario
	precio_venta=$("#pprecio_venta").val();//igual
	
	tipo_comprobante=$("#tipo_comprobante").val();//aqui obtengo el valor del tipo de comprobante, si es factura o es nota de entrega
	
	iva_gestionable=$("#iva_gestionable").val();//aqui obtengo el valor del iva gestionable que viene de la base de datos igual hay que dividirlo entre 100 para poder obtener el iva real
	
		
		descuento=(precio_venta*cantidad)*(descuento)/100;

		subtotal[cont]=(cantidad*precio_venta-descuento);// este será un subtotal por cada fila de la tabla
		total=total+subtotal[cont];//por cada detalle calculo un subtotal

				//arriba recibo el valor con javascrits del tipo_comprobante el cual me dice si se generá una factura o una nota de pago, en factura iva=16% y en nota d epago iva= 0%
				
				//alert(tipo_comprobante);
				if(tipo_comprobante=='1')				
				{
					//iva=0;
					iva=(total*iva_gestionable)/100;	
				}	
				if(tipo_comprobante=='2')
				{	
					iva=(total*iva_gestionable)/100;	
					
				}

				totalpagar=total+iva;//Total a pagar incluyendo el IVA

		
	
	$("#total").html("Bs.S. "+ totalpagar);//ubicate en campo con id=total. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#total_venta").val(totalpagar);//ubicate en campo con id=total. Y con la función val, cargame el input con el valor total, lo enviamos con un val() porq no es html sino input.


	$("#iva").html("Bs.S. "+ iva);//ubicate en campo con id=total. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#total_iva").val(iva);//ubicate en campo con id=total_iva, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor


	$("#base").html("Bs.S. "+ total);//ubicate en campo de html con id=base. Y con la función de html, escribeme en ese campo el simbolo del soles mas el total

	$("#base_imponible").val(total);//ubicate en campo con id=base_imponible, esto lo utilizó para cargar el input moddo hiiden (oculto) con este valor

			
}

</script>

	
@endpush

@endsection