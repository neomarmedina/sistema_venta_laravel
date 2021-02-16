{!! Form::open(array('url'=>'ventas/devolucion','method'=>'GET','aut	ocomplete'=>'off','role'=>'search')) !!}

	<div class="form-group">

		<div class="input-group">
			
		<input type="text" class="form-control" name="searchText" placeholder="Buscar por serie de comprobante ó numero de comprobante" value="{{$searchText}}">

			<span class="input-group-btn">
				
			<button type="submit" class="btn btn-primary">Buscar</button>

			</span>
		</div>	

	</div>
{{Form::close()}}