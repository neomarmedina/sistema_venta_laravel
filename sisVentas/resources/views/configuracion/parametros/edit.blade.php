@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('almacen/categoria')}}"><i class="fa fa-laptop"></i> Gestionar Parametros de Configuracion</a></li>
        <li><a href="#"> Editar Gestionar Parametros de Configuracion
        
      </ol>


	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Actualizar el Parametro{{" ".$parametros->nombre}}</h3>
				
						@if(count($errors)>0)

						<div class="alert alert-danger">
							<ul>
					

									@foreach ($errors->all() as $error)
					
											<li>{{$error}}</li>

									@endforeach

							</ul>

						</div>
						@endif



						{!! Form::model($parametros,['method'=>'PATCH','route'=>['configuracion.parametros.update',$parametros->idparametro]])!!}
						
							{{Form::token()}}

							



								<div class="form-group">
									<label for="valor">Valor</label>
									<input type="text" name="valor" class="form-control"  value="{{$parametros->valor}}" placeholder="Parametro..."></input>								

								</div>


								<div class="form-group"></div>
								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
								


						{!!Form::close()!!}
		</div>
	</div>

@endsection