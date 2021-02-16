@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('talla/tallas')}}"><i class="fa fa-laptop"></i> Gestionar Tallas</a></li>
        <li><a href="#"> Editar Talla
        
      </ol>
    </section>

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Talla:{{$tallas->nombre}}</h3>
				
						@if(count($errors)>0)

						<div class="alert alert-danger">
							<ul>
					

									@foreach ($errors->all() as $error)
					
											<li>{{$error}}</li>

									@endforeach

							</ul>

						</div>
						@endif



						{!! Form::model($tallas,['method'=>'PATCH','route'=>['talla.tallas.update',$tallas->idtalla]])!!}
						
							{{Form::token()}}

								<div class="form-group">
									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" class="form-control" value="{{$tallas->nombre}}" placeholder="Nombre..."></input>								

								</div>



								<div class="form-group">
									<label for="descripcion">Descripción</label>
									<input type="text" name="descripcion" class="form-control"  value="{{$tallas->descripcion}}" placeholder="Descripcion..."></input>								

								</div>


								<div class="form-group"></div>
								<button class="btn btn-primary" type="submit">Guardar</button>
								<button class="btn btn-danger" type="reset">Cancelar</button>
								


						{!!Form::close()!!}
		</div>
	</div>

@endsection