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
    if  (empty($_POST['txtClienteA'])){$codcliente='';}else{ $codcliente = $_POST['txtClienteA'];}
    if  (empty($_POST['txtDesdeFecha'])){$desde='';}else{ $desde= $_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$hasta='';}else{ $hasta= $_POST['txtHastaFecha'];}
    $conectate=pg_connect("host=192.168.0.99 port=5432 dbname=estaciones user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select cli_nom ||' '|| cli_ape as cliente from clientes where cli_cod=$codcliente");
    $cliente=pg_result($consulta,0,'cliente');
    //table header CABECERA        
    $this->SetFont('Arial','B',12);
    $this->SetTitle('Clientes-Estaciones');
    $this->text(55,45,'CONTROL DE ESTACIONES DE SERVICIOS');
    $this->text(60,50,'Ranking de Registros por Clientes');
    $this->text(10,65,'CLIENTE:');//Titulo
    $this->text(45,65,$cliente);
    $this->text(10,75,'DESDE FECHA:');
    $this->text(45,75,$desde);
    $this->text(10,85,'HASTA FECHA:');
    $this->text(45,85,$hasta);
    
}
}
$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();
//------------------------RECIBIMOS LOS VALORES DE POST-----------
    if  (empty($_POST['txtClienteA'])){$codcliente='';}else{ $codcliente = $_POST['txtClienteA'];}
    if  (empty($_POST['txtDesdeFecha'])){$desde='';}else{ $desde= $_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$hasta='';}else{ $hasta= $_POST['txtHastaFecha'];}
    
//-------------------------Damos formato al informe-----------------------------    
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
    
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,100);
$pdf->Cell(40,10,'Cantidad',1,0,'C',50);
$pdf->Cell(40,10,'Aprobados',1,0,'C',50);
$pdf->Cell(40,10,'Reprobados',1,0,'C',50);
$pdf->Cell(40,10,'Clausurados',1,1,'C',50);
$fill=false;
$i=0;
$pdf->SetFont('Arial','',10);

//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=192.168.0.99 port=5432 dbname=estaciones user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"select sum(reg.reg_cant) as reg_cant,sum(reg.reg_aprob) as reg_aprob, sum(reg.reg_reprob)as reg_reprob, 
sum(reg.reg_claus)as reg_claus
from registros reg,usuarios usu,clientes cli 
where reg.cli_cod=cli.cli_cod 
and reg.usu_cod=usu.usu_cod 
and cli.cli_cod=$codcliente
and reg.reg_fecha >= '$desde'
and reg.reg_fecha <= '$hasta' ");
$numregs=pg_numrows($consulta);
while($i<$numregs)
{   
    $cantidad=pg_result($consulta,$i,'reg_cant');
    $aproba=pg_result($consulta,$i,'reg_aprob');
    $reprob=pg_result($consulta,$i,'reg_reprob');
    $claus=pg_result($consulta,$i,'reg_claus');
    $pdf->Cell(40,5,$cantidad,1,0,'C',$fill);
    $pdf->Cell(40,5,$aproba,1,0,'L',$fill);
    $pdf->Cell(40,5,$reprob,1,0,'L',$fill);
    $pdf->Cell(40,5,$claus,1,1,'L',$fill);
    $fill=!$fill;
    $i++;
}

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