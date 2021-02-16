@extends ('layouts.admin')
@section ('contenido')

<section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Panel de control
        <li><a href="{{url('almacen/articulo')}}"><i class="fa fa-laptop"></i> Comisiones</a></li>
        <li><a href="#"> En Contrucción
        
      </ol>
    </section>
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
									<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre..."></input>								
				</div>

		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		
					<div class="form-group">

							<label> Categoría</label>

								<select name="idcategoria" class="form-control">
					
									@foreach ($categorias as $cat)
										<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>

									@endforeach
								</select>
				
					</div>



		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="codigo">Código</label>
									<input type="text" name="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Codigo del articulo..."></input>								
				</div>




		</div>
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="stock">Stock</label>
									<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del articulo..."></input>								
				</div>




		</div>



		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="descripcion">Descripción</label>
									<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del articulo..."></input>								
				</div>






		</div>
		

		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="marca">Marca</label>
									<input type="text" name="marca" value="{{old('marca')}}" class="form-control" placeholder="Marca del articulo..."></input>								
				</div>






		</div>



		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="modelo">Modelo</label>
									<input type="text" name="modelo" value="{{old('modelo')}}" class="form-control" placeholder="Modelo del articulo..."></input>								
				</div>






		</div>
		
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		

				<div class="form-group">
				

									<label for="descripcion">talla</label>
									
									<select name="idtalla" class="form-control">
					
									@foreach ($talla as $tall)
									

							<option value="{{$tall->idtalla}}">{{$tall->nombre}}</option>
							
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