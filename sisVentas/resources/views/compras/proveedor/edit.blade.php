@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('compras/proveedor')}}"><i class="fa fa-th"></i> Gestionar Proveedor</a></li>
        <li><a href="#"> Editar Proveedor
        
      </ol>
    </section>
	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Proveedor</h3>
				
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

{!! Form::model($persona,['method'=>'PATCH','route'=>['compras.proveedor.update',$persona->idpersona]])!!}
						
							{{Form::token()}}

	<div class="row">
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				
				<div class="form-group">
				

									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required value="{{$persona->nombre}}" class="form-control" placeholder="Nombre..."></input>								
				</div>

		</div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" required value="{{$persona->direccion}}" class="form-control" placeholder="Dirección del cliente..."></input>								
				</div>




		</div>



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

							<label> Tipo de documento</label>

								<select name="tipo_documento" class="form-control">
									
										@if ($persona->tipo_documento=='CI')
										
											<option selected value="CI">C.I</option>
											<option value="RIF">RIF</option>
											<option value="PAS">PAS</option>

										@elseif ($persona->tipo_documento=='RIF')
										
											<option value="CI">C.I</option>
											<option selected="" value="RIF">RIF</option>
											<option value="PAS">PAS</option>	
											

										@else ($persona->tipo_documento=='PAS')
										
											<option value="CI">C.I</option>
											<option value="RIF">RIF</option>
											<option selected="" value="PAS">PAS</option>

										
										@endif
									
									
								</select>
				
					</div>



		</div>




		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="num_documento">Número de Doc.</label>
									<input type="text" name="num_documento" required value="{{$persona->num_documento}}" class="form-control" placeholder="Número de Doc..."></input>								
				</div>




		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="codigo">codigo</label>
									<input type="text" name="codigo" value="{{$persona->codigo}}" class="form-control" placeholder="Código del Provee..."></input>								
				</div>






		</div>
		
		


		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" value="{{$persona->telefono}}" class="form-control" placeholder="Teléfono del Provee..."></input>								
				</div>






		</div>
		

<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="email">Email</label>
									<input type="text" name="email" value="{{$persona->email}}" class="form-control" placeholder="Email del Provee..."></input>														
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