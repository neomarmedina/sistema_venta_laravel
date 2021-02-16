@extends ('layouts.admin')
@section ('contenido')


<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('tiendas/tienda')}}"><i class="fa fa-institution"></i> Gestionar Tiendas</a></li>
        <li><a href="#"> Editar Tienda
        
      </ol>
    </section>


	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Tienda {{$tienda->nombre}}</h3>
				
						@if(count($errors)>0)

						<div class="alert alert-danger">
							<ul>
					

									@foreach ($errors->all() as $error)
					
											<li>{{$error}}</li>

									@endforeach

							</ul>

						</div>
						@endif



						{!! Form::model($tienda,['method'=>'PATCH','route'=>['tiendas.tienda.update',$tienda->idtienda]])!!}
						
							{{Form::token()}}

								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" class="form-control" value="{{$tienda->nombre}}" placeholder="Nombre..."></input>								

								</div>



								<div class="form-group">
									<label for="descripcion">Descripción</label>
									<input type="text" name="descripcion" class="form-control"  value="{{$tienda->descripcion}}" placeholder="Descripcion..."></input>								

								</div>

								<div class="form-group">
									<label for="direccion">Dirección</label>
									<input type="text" name="direccion" class="form-control"  value="{{$tienda->direccion}}" placeholder="Dirección..."></input>								

								</div>


								<div class="form-group">
				

									<label for="telefono">Teléfono</label>
									<input type="text" name="telefono" value="{{$tienda->telefono}}" class="form-control" placeholder="Teléfono del cliente..."></input>								
								</div>
								<div class="form-group">
				

									<label for="rif">Rif.</label>
									<input type="text" name="rif" value="{{$tienda->rif}}" class="form-control" placeholder="Rif. de la Empresa..."></input>								
								</div>

									<div class="form-group">
				

									<label for="codigo">Código.</label>
									<input type="text" name="codigo" value="{{$tienda->codigo}}" class="form-control" placeholder="Código de la Empresa..."></input>								
								</div>

								<div class="form-group"></div>
								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
								


						{!!Form::close()!!}
		</div>
	</div>

@endsection