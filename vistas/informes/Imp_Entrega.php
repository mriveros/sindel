<?php 
session_start();
?>
<?php
//Example FPDF script with PostgreSQL
//Ribamar FS - ribafs@dnocs.gov.br

require('fpdf.php');

class PDF extends FPDF{
function Footer()
{
        
       
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(230,280,9,280);//largor,ubicacion derecha,inicio,ubicacion izquierda
    // Go to 1.5 cm from bottom
        $this->SetY(-15);
    // Select Arial italic 8
        $this->SetFont('Arial','I',8);
    // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
}

function Header()
{
   // Select Arial bold 15
    $this->SetFont('Arial','',16);
    $this->Image('img/intn.jpg',10,14,-300,0,'','../../InformeCargos.php');
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->text(37,19,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
    $this->SetFont('Arial','',8);
    $this->text(37,24,"Avda. Gral. Artigas 3973 c/ Gral Roa- Tel.: (59521)290 160 -Fax: (595921) 290 873 ");
    $this->text(37,29,"ORGANISMO NACIONAL DE METROLOGIA");
    $this->text(37,34,"Telefax: (595921) 295 408 e-mail: metrologia@intn.gov.py");
    //-----------------------TRAEMOS LOS DATOS DE CABECERA----------------------
   
    //---------------------------------------------------------
    $this->Ln(30);
    $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(200,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    //------------------------RECIBIMOS LOS VALORES DE POST-----------
    //table header CABECERA        
    $this->SetFont('Arial','B',12);
    $this->SetTitle('SGP-Entregas');
    $this->text(65,50,'SISTEMA CONTROL DE PRECINTADOS');
    $this->text(55,60,'Entrega de Precintos a Puestos de Precintados'); 
}
}
$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();
//------------------------RECIBIMOS LOS VALORES DE POST-----------
    if  (empty($_POST['txtCodigoImprimir'])){$codigo_entrega='';}else{ $codigo_entrega= $_POST['txtCodigoImprimir'];}
   
    
//-------------------------Damos formato al informe-----------------------------    
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
    
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,100);
$pdf->SetFont('Arial','',10);

//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"select en.en_des,en.en_cantidad,en.en_nro_inicio,en.en_nro_fin,enc.en_nom||' '||enc.en_ape as encargado,rem.rem_des,col.col_des 
from entrega en, puestos pues,encargado enc,remisiones rem,color col 
where en.pues_cod=pues.pues_cod 
and en.enc_cod=enc.en_cod 
and en.rem_cod=rem.rem_cod
and rem.col_cod=col.col_cod
and en.en_cod=$codigo_entrega");
$row1 = pg_fetch_array($consulta);
  
$descripcion=$row1['en_des'];
$cantidad=$row1['en_cantidad'];
$nro_inicio=$row1['en_nro_inicio'];
$nro_fin=$row1['en_nro_fin'];
$encargado=$row1['encargado'];
$remision=$row1['rem_des'];
$color=$row1['col_des'];
$pdf->SetFont('Arial','B',10);
$pdf->text(15,80,utf8_decode('Descripción:'));
$pdf->text(15,90,utf8_decode('Cantidad:'));
$pdf->text(80,90,utf8_decode('Desde:'));   
$pdf->text(130,90,utf8_decode('Hasta:'));
$pdf->text(15,100,utf8_decode('Color:')); 

$pdf->text(30,120,'.............................................'); 
$pdf->text(35,125,utf8_decode('Firma Encargado')); 

$pdf->text(130,120,'.............................................'); 
$pdf->text(137,125,'Firma Receptor'); 

$pdf->SetFont('Arial','',10);
$pdf->text(40,80,utf8_decode($descripcion));
$pdf->text(35,90,$cantidad);
$pdf->text(95,90,utf8_decode($nro_inicio));
$pdf->text(145,90,utf8_decode($nro_fin)); 
$pdf->text(35,100,utf8_decode($color));
//Add a rectangle, a line, a logo and some text
/*
$pdf->Rect(5,5,170,80);
$pdf->Line(5,90,90,90);
//$pdf->Image('mouse.jpg',185,5,10,0,'JPG','http://www.dnocs.gov.br');
$pdf->SetFillColor(224,235);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(5,95);
$pdf->Cell(170,5,'PDF gerado via PHP acessando banco de dados - Por Ribamar FS',1,1,'L',1,'mailto:ribafs@dnocs.gov.br');
*/
$pdf->Output();
$pdf->Close();
?>