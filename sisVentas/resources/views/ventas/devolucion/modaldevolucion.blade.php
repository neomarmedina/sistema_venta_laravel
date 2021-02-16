<div class="modal modal-info fade" aria-hidden="true" role="document tabindex="-1 id="modaldevolucion-delete-{{$dev->iddevolucion}}">
	
	{{Form::Open(array('action'=>array('DevolucionController@destroy',$dev->iddevolucion),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modaldevolucion aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Estatus de Devolucion</h4>
				</div>	  
		

				<div class="modal-body">

					<p><b>Esta seguro que desea cambiar el Estatus de Devolución a : Ejecutada  ?</b></p>
					
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Aceptar</button>
				
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>