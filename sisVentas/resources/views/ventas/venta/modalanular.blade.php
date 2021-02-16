<div class="modal modal-info fade" aria-hidden="true" role="document tabindex="-1 id="modalanular-delete-{{$ven->idventa}}">
	
	{{Form::Open(array('action'=>array('VentaController@update',$ven->idventa),'method'=>'PATCH'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modalanular aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Anular neooo Factura Factura N°{{$ven->serie_comprobante}}
					  </h4>
				</div>	  
		

				<div class="modal-body">

				<p><b>Confirme si desea anular la Factura?</b></p>
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-outline">Confirmar</button></b>
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>