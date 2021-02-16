@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-laptop"></i> Gestionar Articulo</a></li>
        <li><a href="#"> Editar Articulo
        
      </ol>

	<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Editar Articulo : {{$articulo->nombre}}</h3>
				
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




						{!! Form::model($articulo,['method'=>'PATCH','route'=>['almacen.articulo.update',$articulo->idarticulo],'files'=>'true'])!!}
						
							{{Form::token()}}




<div class="row">
		
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				
				<h3>Nuevo Articulo</h3>
				
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


				{!! Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true')) !!}
						
				{{Form::token()	}}

	<div class="row">
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				
				<div class="form-group">
				

									<label for="nombre">Nombre</label>
									<input type="text" name="nombre" required value="{{$articulo->nombre}}" class="form-control"></input>								
				</div>

		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

							<label> Categoría</label>

								<select name="idcategoria" class="form-control">
					
									@foreach ($categorias as $cat)
									@if($cat->idcategoria==$articulo->idcategoria)	

										<option value="{{$cat->idcategoria}}" selected>{{$cat->nombre}}</option>
									@else
									<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
									@endif

									@endforeach
								</select>
				
					</div>



		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="codigo">Código</label>
									<input type="text" name="codigo" required value="{{$articulo->codigo}}" class="form-control"></input>								
				</div>




		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="stock">Stock</label>
									<input type="text" name="stock" required value="{{$articulo->stock}}" class="form-control"></input>								
				</div>




		</div>



		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="descripcion">Descripción</label>
									<input type="text" name="descripcion" value="{{$articulo->descripcion}}" class="form-control" placeholder="Descripción del articulo..."></input>								
				</div>






		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="marca">Marca</label>
									<input type="text" name="marca" value="{{$articulo->marca}}" class="form-control" placeholder="Marca del articulo..."></input>								
				</div>






		</div>


		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="modelo">Modelo</label>
									<input type="text" name="modelo" value="{{$articulo->modelo}}" class="form-control" placeholder="Modelo del articulo..."></input>								
				</div>






		</div>


		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="talla">Talla</label>
									



								<select name="idtalla" class="form-control">
					
									@foreach ($talla as $tall)
									@if($tall->idtalla==$articulo->idtalla)	

										<option value="{{$tall->idtalla}}" selected>{{$tall->nombre}}</option>
									@else
									<option value="{{$tall->idtalla}}">{{$tall->nombre}}</option>
									@endif

									@endforeach
								</select>								
				






				</div>






		</div>
		


<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									
						<label for="estado">Estado</label>
						

						<select name="estado" class="form-control">
					
									

										<option value="Activo" selected>Activo</option>
								
									<option value="Inactivo">Inactivo</option>
								
								</select>	



				</div>






		</div>




<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="imagen">Imagen</label>
									<input type="file" name="imagen"  class="form-control">	
									@if(($articulo->imagen!=""))
										<img src="{{asset('imagenes/articulos/'.$articulo->imagen)}}" height="300px width="300px" ">
									@endif

				</div>

				




	</div>




		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									
				</div>


		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									
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