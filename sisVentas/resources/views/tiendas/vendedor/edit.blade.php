@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('tiendas/vendedor')}}"><i class="fa fa-institution"></i> Gestionar Vendedor</a></li>
        <li><a href="#"> Editar Vendedor
        
      </ol>
    </section>


	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Vendedor</h3>
				
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

{!! Form::model($vendedor,['method'=>'PATCH','route'=>['tiendas.vendedor.update',$vendedor->idvendedor]])!!}
						
{{Form::token()}}

	<div class="row">
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				
				<div class="form-group">
				

									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required value="{{$vendedor->nombre}}" class="form-control" placeholder="Nombre..."></input>								
				</div>

		</div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" required value="{{$vendedor->direccion}}" class="form-control" placeholder="Dirección del cliente..."></input>								
				</div>




		</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

							<label> Tipo de documento</label>

								<select name="tipo_documento" class="form-control">
									
										@if ($vendedor->tipo_documento=='CI')
										
											<option selected value="CI">CI</option>
											<option value="RIF">RIF</option>
											<option value="PAS">PAS</option>
										@elseif ($vendedor->tipo_documento=='RIF')	

										
											<option value="CI">CI</option>
											<option selected value="RIF">RIF</option>
											<option value="PAS">PAS</option>
										@else
										
										    <option value="CI">CI</option>
											<option value="RIF">RIF</option>
											<option selected value="PAS">PAS</option>


										@endif
									
									
								</select>
				
					</div>



		</div>




		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_documento">Numero de Doc.</label>
									<input type="text" name="num_documento" required value="{{$vendedor->num_documento}}" class="form-control" placeholder="Número de Doc..."></input>								
				</div>




		</div>
		


		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" value="{{$vendedor->telefono}}" class="form-control" placeholder="Teléfono del cliente..."></input>								
				</div>






		</div>
		

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="email">Email</label>
									<input type="text" name="email" value="{{$vendedor->email}}" class="form-control" placeholder="Email del cliente..."></input>														
				</div>

				




		</div>



		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="comision">% deComision Venta</label>
									<input type="text" name="comision" required value="{{$vendedor->comision}}" class="form-control" placeholder=" % de Comisión por Venta..."></input>								
				</div>


		</div>


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

							<label> Tipo de vendedor</label>

								<select name="tipo_vendedor" class="form-control">
									
										@if ($vendedor->tipo_vendedor=='Activo')
										
											<option selected value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
											
										@else ($persona->tipo_documento=='RUC')	

											<option value="Activo">Activo</option>
											<option selected value="Inactivo">Inactivo</option>
											
										


										@endif
									
									
								</select>
				
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