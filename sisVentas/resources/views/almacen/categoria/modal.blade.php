<div class="modal modal-info fade" aria-hidden="true" role="dialog tabindex="-1 id="modal-delete-{{$cat->idcategoria}}">
	
	{{Form::Open(array('action'=>array('CategoriaController@destroy',$cat->idcategoria),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modal aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Eliminar Departamento</h4>
				</div>	  
		

				<div class="modal-body">

				<p>Confirme si desea eliminar Departamento </p>
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button></b>
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>