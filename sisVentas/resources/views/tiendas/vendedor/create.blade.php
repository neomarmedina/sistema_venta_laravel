@extends ('layouts.admin')
@section ('contenido')


<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('tiendas/vendedor')}}"><i class="fa fa-institution"></i> Gestionar Vendedor</a></li>
        <li><a href="#"> Registrar Vendedor
        
      </ol>
    </section>
	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Nuevo Vendedor</h3>
				
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


				{!! Form::open(array('url'=>'tiendas/vendedor','method'=>'POST','autocomplete'=>'off'))!!}
						
				{{Form::token()	}}

	<div class="row">
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				
				<div class="form-group">
				

									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..."></input>								
				</div>

		</div>
		





	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Dirección del cliente..."></input>								
				</div>

		</div>






		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

						<label for="tipo_documento">Documento de Identificación</label>
						

						<select name="tipo_documento" class="form-control">
					
									
										<option selected="" value="CI">C.I</option>
										<option value="DNI">DNI</option>
										<option value="RUC">RUC</option>
										<option value="PAS">PAS</option>

								
								</select>
					</div>



		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_documento">Número de Identidad</label>
									<input type="text" name="num_documento" required value="{{old('num_documento')}}" class="form-control" placeholder="Número de Identidad..."></input>								
				</div>




		</div>
	



		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" value="{{old('telefono')}}" class="form-control" placeholder="Teléfono del cliente..."></input>								
				</div>






		</div>
		

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="email">Email</label>
									<input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email del cliente..."></input>														
				</div>

				




		</div>


		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		

				<div class="form-group">
				

									<label for="comision">% de Comision por Ventas</label>
									<input type="text" name="comision" required value="{{old('comision')}}" class="form-control" placeholder="% de Comisión por Venta..."></input>								
				</div>




		</div>




			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
	

							<div class="form-group">
								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
							</div>
								

			</div>
								
</div>


								



{!!Form::close()!!}
	
@endsection