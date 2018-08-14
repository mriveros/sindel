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
    
    /***********************************OBTENER DATOS DEL FORMULARIO Y DATOS CABECERA***********************************/
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtPuestos'])){$codigo_puesto=0;}else{$codigo_puesto=$_POST['txtPuestos'];}
    if  (empty($_POST['txtEmblema'])){$codigo_emblema=0;}else{$codigo_emblema=$_POST['txtEmblema'];}
    /********************************************************************************************************************/
        $this->SetFont('Arial','B',8);
        $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres")or die ('Error al conectar a la base de datos');
        $consulta=pg_exec($conectate,"select sum(pre.prec_cantprecinto) as prec_cantprecinto, sum(pre.prec_precio) as prec_precio
        from puestos pues,precintado pre,emblemas em
        where pues.pues_cod=pre.pues_cod
        and em.em_cod=pre.em_cod
        and pre.prec_fecha>='$fechadesde' 
        and pre.prec_fecha <= '$fechahasta'
        and pues.pues_cod=$codigo_puesto
        and em.em_cod=$codigo_emblema");
        $row1 = pg_fetch_array($consulta);
        $precinto_total=$row1['prec_cantprecinto'];
        $precio_total=$row1['prec_precio'];
        
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(343,236,15,236);//largor,ubicacion derecha,inicio,ubicacion izquierda
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        $this->text(15,220,'Total de Precinto Utilizados: '.$precinto_total);
        $this->text(15,225,'Total Precio: '.$precio_total);
        // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(15,234,'Consulta Generada: '.date('d-M-Y').' '.date('h:i:s'));
}

function Header()
{
    // Select Arial bold 15
        $this->SetFont('Arial','',9);
	$this->Image('img/intn.jpg',15,10,-300,0,'','../../InformeCargos.php');
        // Move to the right
        $this->Cell(80);
        // Framed title
	$this->text(15,32,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
	$this->text(315,32,'Sistema de Control de Precintado');
        //$this->text(315,37,'Mes: '.utf8_decode(genMonth_Text($mes).' Año: 2016'));
	//$this->Cell(30,10,'noc',0,0,'C');
        // Line break
        $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(360 ,33,10,33);//largor,ubicacion derecha,inicio,ubicacion izquierda
    
    
    
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtPuestos'])){$codigo_puesto=0;}else{$codigo_puesto=$_POST['txtPuestos'];}
    if  (empty($_POST['txtEmblema'])){$codigo_emblema=0;}else{$codigo_emblema=$_POST['txtEmblema'];}
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select pues_des from puestos where pues_cod=$codigo_puesto"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_puesto=$row1['pues_des'];
    
    $consulta=pg_exec($conectate,"select em_des from emblemas where em_cod=$codigo_emblema"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_emblema=$row1['em_des'];
    
    $this->SetFont('Arial','B',8);
    $this->SetTitle('Resumen Puesto-Emblemas');
    $this->Cell(350,1,'RESUMEN DE PRECINTADOS POR PUESTOS Y EMBLEMAS',100,100,'C');//Titulo
    $this->text(15,50,'PUESTO: ');
    $this->text(32,50,$nombre_puesto);
    $this->text(15,55,'EMBLEMA: ');
    $this->text(32,55,$nombre_emblema);
    $this->text(15,60,'DESDE: ');
    $this->text(30,60,$fechadesde);
    $this->text(15,65,'HASTA: ');
    $this->text(30,65,$fechahasta);
    $this->SetFillColor(153,192,141);
    $this->SetTextColor(255);
    $this->SetDrawColor(153,192,141);
    $this->SetLineWidth(.3);
    
    $this->SetXY(10,70 );
    
    $this->Cell(25,10,'Item',1,0,'C',1);
    $this->Cell(60,10,'Destino',1,0,'C',1);
    $this->Cell(60,10,'Transportista',1,0,'C',1);
    $this->Cell(50,10,'Codigo Camion',1,0,'C',1);
    $this->Cell(50,10,'Fecha',1,0,'C',1);
    $this->Cell(30,10,'Cantidad Precintos',1,0,'C',1);
    $this->Cell(30,10,'Precio',1,1,'C',1);

}
}

$pdf=new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
/***********************************OBTENER DATOS DEL FORMULARIO Y DATOS CABECERA***********************************/
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtPuestos'])){$codigo_puesto=0;}else{$codigo_puesto=$_POST['txtPuestos'];}
    if  (empty($_POST['txtEmblema'])){$codigo_emblema=0;}else{$codigo_emblema=$_POST['txtEmblema'];}
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select pues_des from puestos where pues_cod=$codigo_puesto"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_puesto=$row1['pues_des'];
/********************************************************************************************************************/
  
//------------------------------------------------------------------------------      
$pdf->AddPage('L', 'Legal');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);

$consulta=pg_exec($conectate,"select em.em_des,pues.pues_des, pre.prec_destino,pre.prec_transportista,pre.cam_cod,pre.prec_cantprecinto,pre.prec_precio,to_char(pre.prec_fecha,'DD/MM/YYYY' ) as prec_fecha
    from puestos pues,precintado pre,emblemas em
    where pues.pues_cod=pre.pues_cod
    and em.em_cod=pre.em_cod
    and pre.prec_fecha>='$fechadesde' 
    and pre.prec_fecha <= '$fechahasta'
    and pues.pues_cod=$codigo_puesto
    and em.em_cod=$codigo_emblema");

$numregs=pg_numrows($consulta);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0);
//Build table
$fill=false;
$i=0;
while($i<$numregs)
{
    $destino=pg_result($consulta,$i,'prec_destino');
    $transportista=pg_result($consulta,$i,'prec_transportista');
    $codigo_camion=pg_result($consulta,$i,'cam_cod');
    $cantidad_precinto=pg_result($consulta,$i,'prec_cantprecinto');
    $precio=pg_result($consulta,$i,'prec_precio');
    $fecha=pg_result($consulta,$i,'prec_fecha');
   

    
    $pdf->Cell(25,5,$i+1,1,0,'C',$fill);
    $pdf->Cell(60,5,$destino,1,0,'L',$fill);
    $pdf->Cell(60,5,$transportista,1,0,'L',$fill);
    $pdf->Cell(50,5,$codigo_camion,1,0,'C',$fill);
    $pdf->Cell(50,5,$fecha,1,0,'C',$fill);
    $pdf->Cell(30,5,$cantidad_precinto,1,0,'C',$fill);
    $pdf->Cell(30,5,$precio,1,1,'C',$fill);
    
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
ob_end_clean();
$pdf->Output();
$pdf->Close();
// generamos los meses 
function genMonth_Text($m) { 
 switch ($m) { 
  case '01': $month_text = "Enero"; break; 
  case '02': $month_text = "Febrero"; break; 
  case '03': $month_text = "Marzo"; break; 
  case '04': $month_text = "Abril"; break; 
  case '05': $month_text = "Mayo"; break; 
  case '06': $month_text = "Junio"; break; 
  case '07': $month_text = "Julio"; break; 
  case '08': $month_text = "Agosto"; break; 
  case '09': $month_text = "Septiembre"; break; 
  case '10': $month_text = "Octubre"; break; 
  case '11': $month_text = "Noviembre"; break; 
  case '12': $month_text = "Diciembre"; break; 
 } 
 return ($month_text); 
} 
?>