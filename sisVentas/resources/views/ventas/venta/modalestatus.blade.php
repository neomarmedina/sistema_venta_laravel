<div class="modal modal-info fade" aria-hidden="true" role="document tabindex="-1 id="modalestatus-delete-{{$ven->idventa}}">
	
	{{Form::Open(array('action'=>array('VentaController@destroy',$ven->idventa),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modalestatus aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Estatus de Factura</h4>
				</div>	  
		

				<div class="modal-body">

				<p><b>Esta factura se encuentra en Estatus : "PAGADO" ?</b></p>
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Aceptar</button>
				
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>