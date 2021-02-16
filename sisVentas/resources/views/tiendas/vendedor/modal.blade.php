<div class="modal fade modal-slide-in-righ" aria-hidden="true" role="dialog tabindex="-1 id="modal-delete-{{$vend->idvendedor}}">
	
	{{Form::Open(array('action'=>array('VendedorController@destroy',$vend->idvendedor),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modal aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Eliminar Vendedor</h4>
				</div>	  
		

				<div class="modal-body">

				<p>Confirme si desea eliminar el Vendedor</p>
					
				</div>
				<div class="moda
l-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button></b>
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>