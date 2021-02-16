@extends ('layouts.admin')
@section ('contenido')
<?php
//include("../fpdf/fpdf.php");





include("fpdf/fpdf.php");
class PDF extends FPDF
{
	
	
function cuerpo_completo(){

session_start();


	$session_venta=\session::get('session_venta');
	foreach ($session_venta as $ven)
    {
    	$neo=$ven->tienda;
    	


	}//AQUI CIERRO EL FOREACH QUE ESTA AL INICIO


//$neo=5;

$this->SetFont('Arial', '', 6);  
$fecha=date("d/m/Y");
$hora=date("H:i:s");
 
$this->Ln();

			
$this->SetXY(16	,25);				
$this->Cell(150,6,utf8_decode("RAZON SOCIAL neonn:"),0,0,'L',false);
$this->Cell(40,6,utf8_decode("FECHA        :".$neo),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(150,6,utf8_decode("DIRECCION   : CALLE CASTELLOS CENTRO COMERCIAL SAN PEDRO"),0,0,'L',false);
$this->Cell(40,6,utf8_decode("No. FACTURA  : A00241050"),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(60,6,utf8_decode("RIF          : J406008265"),0,0,'L',false);
$this->Cell(90,6,utf8_decode("No. PEDIDO:  02000458"),0,0,'L',false);
$this->Cell(40,6,utf8_decode("CONDICION    :CONTADO"),0,0,'L',false);
$this->Ln();
$this->SetX(16);

$this->Cell(60,6,utf8_decode("CODIGO       : 002768"),0,0,'L',false);
$this->Cell(90,6,utf8_decode("TELEFONO:  "),0,0,'L',false);
$this->Cell(40,6,utf8_decode("VENDEDOR     :24"),0,0,'L',false);

$this->Ln();
$this->Ln();

$this->SetX(16);				
$this->Cell(22,4,utf8_decode("CANT"),0,0,'L',false);
$this->Cell(15,4,utf8_decode("CODIGO"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("DESCRIPCION"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("PRECIO CAJA"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("% DCTO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("PRECIO C/DCTO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("IMPORTE NETO"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("% ALIC"),0,0,'L',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(22,4,utf8_decode(" 0.50  CAJA"),0,0,'L',false);
$this->Cell(15,4,utf8_decode(" 018319"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("LC DERMOX ANTIEDAD 12X350"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("0.00"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("108,655.20"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("16"),0,0,'L',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(22,4,utf8_decode(" 0.50  CAJA"),0,0,'L',false);
$this->Cell(15,4,utf8_decode(" 018319"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("LC DERMOX ANTIEDAD 12X350"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("0.00"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("108,655.20"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("16"),0,0,'L',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(22,4,utf8_decode(" 0.50  CAJA"),0,0,'L',false);
$this->Cell(15,4,utf8_decode(" 018319"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("LC DERMOX ANTIEDAD 12X350"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("0.00"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("108,655.20"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("16"),0,0,'L',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(22,4,utf8_decode(" 0.50  CAJA"),0,0,'L',false);
$this->Cell(15,4,utf8_decode(" 018319"),0,0,'L',false);
$this->Cell(48,4,utf8_decode("LC DERMOX ANTIEDAD 12X350"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("0.00"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("217,310.40"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("108,655.20"),0,0,'L',false);
$this->Cell(22,4,utf8_decode("16"),0,0,'L',false);

$this->Ln();
$this->SetXY(16,110);				
$this->Cell(100,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("DESCUENTO:  "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("0.00"),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("SUBTOTAL:  "),0,0,'R',false);
$this->Cell(20,4,utf8_decode("1,659,886.42"),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("GRAV. (1,%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("1,659,886,42"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("IVA(16 %):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("265,581.83"),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("Exento :"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("1,659,886.42"),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("GRAV. (8%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("0.00"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("IVA( 8%):"),0,0,'L',false);
$this->Cell(20,4,utf8_decode("0.00"),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("TOTAL IVA:"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("265,581.83"),0,0,'R',false);

$this->Ln();
$this->SetX(16);				
$this->Cell(60,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'R',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode(" "),0,0,'R',false);
$this->Cell(4,4,utf8_decode(" "),0,0,'L',false);
$this->Cell(20,4,utf8_decode("TOTAL A PAGAR:"),0,0,'R',false);
$this->Cell(20,4,utf8_decode("1,925,468.25"),0,0,'R',false);

}
}

$pdf=new PDF();
$pdf->SetAutoPageBreak(true,20);
$pdf->AddPage();
$pdf->cuerpo_completo();
$pdf->Output('reporte.pdf','D');




?>







@endsection