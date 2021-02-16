<div class="modal modal-info fade" aria-hidden="true" role="document tabindex="-1 id="modaldevolucion-delete-{{$ven->idventa}}">
	
	{{Form::Open(array('action'=>array('VentaController@destroy',$ven->idventa),'method'=>'delete'))}}
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					  <button type="button" class="close" data-dismiss=modaldevolucion aria-label="Close">
					  	
					  <span aria-hidden="true">x</span>

					  </button>
					  <h4 class="modal-title">Estatus de Factura</h4>
				</div>	  
		

				<div class="modal-body">

					<p><b>Esta seguro que desea realizar una devolución en la Factura N° {{$ven->serie_comprobante}}  ?</b></p>
					
					
				</div>

				<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Aceptar</button>
				
				
				</div>				
			</div>
	</div>
{{Form::close()}}

</div>