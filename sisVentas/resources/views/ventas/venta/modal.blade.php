<div class="modal modal-info fade" aria-hidden="true" role="document tabindex="-1 id="modal-delete-{{$ven->idventa}}">
	
	{{Form::Open(array('action'=>array('VentaController@destroy',$ven->idventa),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modal aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Cambiar Estatus de Factura</h4>
				</div>	  
		

				<div class="modal-body">

				<p><b>Confirme si desea cambiar el Estatus de la venta a : "PAGADO" ?</b></p>
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button></b>
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>