@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('ventas/cliente')}}"><i class="fa fa-shopping-cart"></i> Gestionar Cliente</a></li>
        <li><a href="#"> Registrar cliente
        
      </ol>
    </section>

	<div class="row">		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">				
				<h3>Nuevo Cliente</h3>				
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

				{!! Form::open(array('url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'))!!}
						
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
						<label for="tipo_documento">Documento</label>						
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

									<label for="num_documento">Número de documento</label>
									<input type="text" name="num_documento" required value="{{old('num_documento')}}" class="form-control" placeholder="Número de Doc..."></input>								
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



<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
				<div class="form-group">
				
									<label for="codigo">Código</label>
									<input type="text" name="codigo" value="{{old('codigo')}}" class="form-control" placeholder="Código del cliente..."></input>														
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