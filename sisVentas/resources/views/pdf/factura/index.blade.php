
<?php
//include("../fpdf/fpdf.php");
include("fpdf/fpdf.php");
class PDF extends FPDF
{
	
//Aqui recibo por parametros los valores que me envian al final del archivo donde se invoca la funcion cuerpo_completo	
function cuerpo_completo($razon,$detalle,$direccion,$rif_empresa,$vendedor,$cedula_vendedor,$codigo_tienda,$tlf_tienda,$iva,$tipo_comprobante,$tipo_documento){

	


$this->SetFont('Arial', '', 6);  
$fecha=date("d/m/Y");
$hora=date("H:i:s");
 
$this->Ln();

			
$this->SetXY(16	,25);				
$this->Cell(150,6,utf8_decode("$tipo_documento : $razon:"),0,0,'L',false);
$this->Cell(40,6,utf8_decode("FECHA        : $fecha"),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(150,6,utf8_decode("DIRECCION : ".$direccion),0,0,'L',false);
$this->Cell(40,6,utf8_decode("No. FACTURA  : A00241050"),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(60,6,utf8_decode("RIF          :".$rif_empresa),0,0,'L',false);
$this->Cell(90,6,utf8_decode("No. PEDIDO:  02000458"),0,0,'L',false);
$this->Cell(40,6,utf8_decode("CONDICION    :CREDITO-5-DIAS"),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(60,6,utf8_decode("CODIGO       : ".$codigo_tienda),0,0,'L',false);
$this->Cell(90,6,utf8_decode("TELEFONO:  ".$tlf_tienda),0,0,'L',false);
$this->Cell(40,6,utf8_decode("VENDEDOR     : ".$vendedor."-CI.".$cedula_vendedor),0,0,'L',false);

$this->Ln();
$this->Ln();

$this->SetX(16);				
$this->Cell(22,4,utf8_decode("CANT"),0,0,'L',false);
$this->Cell(15,4,utf8_decode("CODIGO"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("DESCRIPCION"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("UNIDAD.M--PRECIO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("% DCTO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("PRECIO C/DCTO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("IMPORTE NETO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("% ALIC"),0,0,'L',false);

$descuentoglobal=0;//declaraciones en 0
$total_venta=0;//declaraciones en 0
$subtotal=0;
$total_iva=0;
$detalle_listado = json_decode($detalle, 1);
foreach($detalle_listado as $detalle_listado) 
{

//Esto es por cada articulo que tenga la venta se dibujara un registro

   $unidad_medida=$detalle_listado['unidad_medida'];
   $articulo_mostrar=$detalle_listado['articulo'];
   $codigo=$detalle_listado['codigo'];
   $descripcion=$detalle_listado['descripcion'];

   $cantidad=$detalle_listado['cantidad'];
   
   $precio_venta=$detalle_listado['precio_venta'];
   
   $descuento=$detalle_listado['descuento'];


   $precio_con_descuento=$detalle_listado['precio_venta']-$detalle_listado['descuento'];


   $descuentoglobal= $descuentoglobal+$detalle_listado['descuento'];
   
   $subtotal=$subtotal+$precio_con_descuento;

   $total_iva=($subtotal)*$iva/100;

   $total_pagar=$precio_con_descuento+$total_iva;
   
   $importe_neto= $precio_con_descuento*$cantidad;

$this->Ln();
$this->SetX(16);				
$this->Cell(22,4,utf8_decode($cantidad),0,0,'L',false);
$this->Cell(15,4,utf8_decode($codigo),0,0,'L',false);
$this->Cell(48,4,utf8_decode($descripcion),0,0,'L',false);
$this->Cell(22,4,utf8_decode($unidad_medida."--".$precio_venta),0,0,'L',false);
$this->Cell(22,4,utf8_decode($descuento),0,0,'L',false);
$this->Cell(22,4,utf8_decode($precio_con_descuento),0,0,'L',false);
$this->Cell(22,4,utf8_decode($importe_neto),0,0,'L',false);
$this->Cell(22,4,utf8_decode($iva.",00"),0,0,'L',false);
}


$this->Ln();
$this->SetXY(16,110);				
$this->Cell(100,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("DESCUENTO :  "),0,0,'L',false);
$this->Cell(20,4,utf8_decode($descuentoglobal),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("SUBTOTAL:  "),0,0,'R',false);
$this->Cell(20,4,utf8_decode($subtotal),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(""),0,0,'L',false);
$this->Cell(20,4,utf8_decode("GRAV. (1,%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode($subtotal),0,0,'R',false);
$this->Cell(20,4,utf8_decode("IVA($iva.%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("$total_iva,00"),0,0,'R',false);
$this->Cell(4,4,utf8_decode(""),0,0,'L',false);
$this->Cell(20,4,utf8_decode("Exento :"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("00,00"),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("GRAV. (8%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("0.00"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("IVA( 8%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("0.00"),0,0,'R',false);
$this->Cell(4,4,utf8_decode(""),0,0,'L',false);
$this->Cell(20,4,utf8_decode("TOTAL IVA:"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("$total_iva"),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'R',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("TOTAL A PAGAR:"),0,0,'R',false);
$this->Cell(20,4,utf8_decode($total_pagar),0,0,'R',false);

}
}

//Estos valores los debo pasar por parametros a LA FUNCION : cuerpo_completo()

$razon=$venta->nombre;//es un ejemplo , hay que colocar la que corresponde 
$direccion=$venta->direccion_cliente;
$rif_empresa=$venta->num_documento;
$tipo_documento=$venta->tipo_documento;
$codigo_tienda=$venta->codigo_cliente;
$tlf_tienda=$venta->telefono_cliente;
$vendedor=$venta->vendedor;
$cedula_vendedor=$venta->cedula_vendedor;//es un ejemplo , hay que colocar la que corresponde $pdf->cuerpo_completo() para poder imprimirlos en el pdf

$tipo_comprobante=$venta->tipo_comprobante;



//$detalle=json_encode($iva);

//Aqui estoy Obteniendo el valor del iva desde el controlador y le digo que si no es una factura que tome el valor de cero
foreach($iva as $iv) 
{
	if($tipo_comprobante=='Factura')
	{

		$iva=$iv->valor;	
	}
	else
	{
		//$iva=0;
		$iva=$iv->valor;	
	}	

	
}
$detalle=json_encode($detalles);



$pdf=new PDF();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();

$pdf->cuerpo_completo($razon,$detalle,$direccion,$rif_empresa,$vendedor,$cedula_vendedor,$codigo_tienda,$tlf_tienda,$iva,$tipo_comprobante,$tipo_documento);

$pdf->Output('reporte.pdf','D');


?>
