<?php
session_start();
require('./fpdf.php');
include '../MonedaTexto.php';
class PDF extends FPDF{
    
function Footer()
{
	/*$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(230,280,9,280);//largor,ubicacion derecha,inicio,ubicacion izquierda
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
        // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(10,283,'Datos Generados en: '.date('d-M-Y').' '.date('h:i:s'));
          */
         
}
function Header()
{
   // Select Arial bold 15
    $this->SetFont('Arial','',12);
    $this->Image('img/intn.jpg',10,14,-300,0,'','../../InformeCargos.php');
    // Move to the right
    $this->Cell(80);
    // Framed title
    $this->text(45,19,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
    $this->SetFont('Arial','',8);
    $this->text(80,24,utf8_decode("Organismo Nacional de Metrología"));
    $this->text(75,29,utf8_decode("Programa Precintado de Camiones Cisterna"));
    $this->text(84,34,utf8_decode("Nota de Remisión de Precintos"));
    $this->text(95,38,"F-PP-001");
        $this->Ln(30);
        $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(200,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    //------------------------RECIBIMOS LOS VALORES DE GET-----------
    
    if  (empty($HTTP_GET_VARS["codigo_precintado"])){$codigo_precintado='';}else{ $codigo_precintado = $HTTP_GET_VARS["codigo_precintado"];}
    
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select pre.prec_cod,pues.pues_des,pre.prec_fecha,em.em_des,pre.cam_cod,
        pre.prec_destino,pre.prec_cantprecinto,pre.prec_gasoil,pre.prec_alconafta,pre.prec_nafta85,
        pre.prec_nafta95,pre.prec_kerosene,pre.prec_turbo,pre.prec_avigas,pre.prec_fueloil,
        pre.prec_alcohol,pre.prec_nafta90,pre.prec_transportista,pre.prec_destino,pre.prec_cantprecinto,
        preci.pre_nom ||' ' ||preci.pre_ape as precintador,enc.en_nom ||' ' ||enc.en_ape as encargado
        from precintado pre, emblemas em, puestos pues, encargado enc,precintador preci
        where pre.pues_cod=pues.pues_cod
        and pre.em_cod=em.em_cod
        and pre.enc_cod=enc.en_cod
        and pre.preci_cod=preci.pre_cod
        and pre.prec_cod=20");
    $row1 = pg_fetch_array($consulta);
    $puesto=$row1['pues_des'];
    $fecha=$row1['prec_fecha'];
    $emblema=$row1['em_des'];
    $codigo_camion=$row1['cam_cod'];
    $destino=$row1['prec_destino'];
    $gasoil=$row1['prec_gasoil'];
    $alconafta=$row1['prec_alconafta'];
    $nafta85=$row1['prec_nafta85'];
    $nafta90=$row1['prec_nafta90'];
    $nafta95=$row1['prec_nafta95'];
    $kerosene=$row1['prec_kerosene'];
    $turbo=$row1['prec_turbo'];
    $avigas=$row1['prec_avigas'];
    $fueloil=$row1['prec_fueloil'];
    $transportista=$row1['prec_transportista'];
    $destino=$row1['prec_destino'];
    $cantidad=$row1['prec_cantprecinto'];
    $letra_cantidad=get_CantidadLetras($cantidad);
    $precintador=$row1['precintador'];
    $encargado=$row1['encargado'];
    //table header CABECERA        
    $this->SetFont('Arial','',10);
    $this->SetTitle('Precintado');
    //---------------------Encabezado Izquierda--------------------------------
    $this->text(12,45,'Lugar de Precintado:');
    $this->text(47,45,$puesto);
    $this->text(12,50,utf8_decode('Emblema del Camión:'));
    $this->text(50,50,$emblema);
    $this->text(12,55,utf8_decode('Transportista:'));
    $this->text(35,55,$transportista);
    $this->text(12,60,utf8_decode('Estacion de Servicio destino de la carga:'));
     $this->text(80,60,$destino);
    //---------------------Encabezado Derecha--------------------------------
    $this->text(130,45,'Fecha:');//Titulo
    $this->text(143,45,$fecha);
    $this->text(130,50,utf8_decode('Código de Camión Cisterna:'));
    $this->text(175,50,$codigo_camion);
    
    //-----------------------Datos Adjuntos-----------------------------------
    $this->Line(200,65,10,65);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->Line(10,65,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->Line(200,65,200,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->SetFont('Arial','B',10);
    $this->text(60,69,'Datos Proporcionados por el transportista');
    $this->SetFont('Arial','',10);
    $this->text(10,73,'Producto');//Columna 1
    $this->text(50,73,'Cantidad');//Columna 2
    $this->text(110,73,'Producto');//Columna 3
    $this->text(150,73,'Cantidad');//Columna 4
    $this->text(10,78,'Gasoil:');
    $this->text(10,83,'Alconafta:');
    $this->text(10,88,'Nafta 85:');
    $this->text(10,93,'Nafta 90:');
    $this->text(10,98,'Nafta 95:');
    $this->text(50,78,$gasoil);
    $this->text(50,83,$alconafta);
    $this->text(50,88,$nafta85);
    $this->text(50,93,$nafta90);
    $this->text(50,98,$nafta95);
    $this->text(110,78,'Kerosene:');
    $this->text(110,83,'Turbo:');
    $this->text(110,88,'Avigas:');
    $this->text(110,93,'Fuel-Oil:');
    $this->text(150,78,$kerosene);
    $this->text(150,83, $turbo);
    $this->text(150,88,$avigas);
    $this->text(150,93,$fueloil);
    $this->Line(200,100,10,100);//largor,ubicacion derecha,inicio,ubicacion izquierda
    
    $this->text(10,105  ,'Precintos aplicados al camion cisterna. Cantidad: '.$cantidad);
    $this->text(105,105,'('.$letra_cantidad.')');
    
    $this->Line(160,40,10,40);//largor,ubicacion derecha,inicio,ubicacion izquierda
    $this->text(10,180,'------------------------------ ');
    $this->text(80,180,'------------------------------ ');
    $this->text(160,180,'------------------------------ ');
    $this->SetFont('Arial','',8);
    $this->text(15,183,'Firma Precintador');
    $this->text(82,183,'Firma Encargado INTN');
    $this->text(165,183,'Firma Transportista');
    $this->text(10,189,utf8_decode('Aclaración: '.$precintador.''));
    $this->text(80,189,utf8_decode('Aclaración: '.$encargado.''));
    $this->text(160,189,utf8_decode('Aclaración: '.$transportista.''));
    }
}

$pdf= new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
$pdf->AddPage();
//------------------------RECIBIMOS LOS VALORES DE GET-----------
if  (empty($HTTP_GET_VARS["codigo_precintado"])){$codigo_precintado='';}else{ $codigo_precintado = $HTTP_GET_VARS["codigo_precintado"];}
//------------------------QUERY and data cargue y se reciben los datos-----------
$conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
$consulta=pg_exec($conectate,"select pre_nro from precintado_detalle where prec_cod=20");
$row1 = pg_fetch_array($consulta);
$precinto1=$row1[0];
$precinto2=$row1[1];
$precinto3=$row1[2];
$precinto4=$row1[3];
$precinto5=$row1[4];
$precinto6=$row1[5];
$precinto7=$row1[6];
$precinto8=$row1[7];
$precinto9=$row1[8];
$precinto10=$row1[9];
$precinto11=$row1[10];
$precinto12=$row1[11];
$precinto13=$row1[12];
$precinto14=$row1[13];
$precinto15=$row1[14];
$precinto16=$row1[15];
$precinto17=$row1[16];
$precinto18=$row1[17];
$precinto19=$row1[18];
$precinto20=$row1[19];
$precinto21=$row1[20];
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
   
//----------------------------Build table---------------------------------------
$pdf->SetXY(10,112 );
$pdf->Cell(25,7,'Compart. 1',1,0,'C',10);
$pdf->Cell(25,7,'Compart. 2',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 3',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 4',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 5',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 6',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 7',1,1,'C',50);
$pdf->Cell(25,7,$precinto1,1,0,'C',10);
$pdf->Cell(25,7,$precinto2,1,0,'C',50);
$pdf->Cell(25,7,$precinto3,1,0,'C',50);
$pdf->Cell(25,7,$precinto4,1,0,'C',50);
$pdf->Cell(25,7,$precinto5,1,0,'C',50);
$pdf->Cell(25,7,$precinto6,1,0,'C',50);
$pdf->Cell(25,7,$precinto7,1,1,'C',50);
$pdf->Cell(25,7,$precinto8,1,0,'C',10);
$pdf->Cell(25,7,$precinto9,1,0,'C',50);
$pdf->Cell(25,7,$precinto10,1,0,'C',50);
$pdf->Cell(25,7,$precinto11,1,0,'C',50);
$pdf->Cell(25,7,$precinto12,1,0,'C',50);
$pdf->Cell(25,7,$precinto13,1,0,'C',50);
$pdf->Cell(25,7,$precinto14,1,1,'C',50);
$pdf->Cell(25,7,$precinto15,1,0,'C',10);
$pdf->Cell(25,7,$precinto16,1,0,'C',50);
$pdf->Cell(25,7,$precinto17,1,0,'C',50);
$pdf->Cell(25,7,$precinto18,1,0,'C',50);
$pdf->Cell(25,7,$precinto19,1,0,'C',50);
$pdf->Cell(25,7,$precinto20,1,0,'C',50);
$pdf->Cell(25,7,$precinto21,1,1,'C',50);

$fill=false;
$i=0;
$pdf->SetFont('Arial','',10);




$pdf->SetFont('Arial','B',10);
$pdf->text(10,146,'Declaramos');
$pdf->SetFont('Arial','',10);
$pdf->text(30,146,utf8_decode('nuestra conformidad en relación a los datos que anteceden asi como de la correcta aplicación de los precintos'));
$pdf->text(10,150,utf8_decode('de las bocas de carga y descarga cuyos numeros se citan en esta Nota de Remisión de Precintos.'));
$pdf->text(10,154,utf8_decode('El chofer transportista es responsable de la devolución en buenas condiciones del total de los precintos utilizados'));
$pdf->text(10,158,utf8_decode('y la nota de Remisión de Precintos. '));
$pdf->SetFont('Arial','B',10);
$pdf->text(68,158,utf8_decode('No volverá a cargar si no devuelve conforme o si tuviere observaciones de la '));
$pdf->text(10,162,utf8_decode('Estacion de Servicios. No se premitirá enmienda en los números de precintos. '));
$pdf->SetFont('Arial','',10);
$pdf->text(10,166,utf8_decode('Para la nueva carga debe pasar por el INTN para la solución del inconveniente presentado conforme las disposiciones al'));
$pdf->text(10,170,utf8_decode('respecto.'));

//-------------------------TEXTO  DE OBSERVACION--------------------------------------


$pdf->SetFont('Arial','B',10);
$pdf->text(10,197,'OBSERVACION:');
$pdf->SetFont('Arial','',10);
$pdf->text(39,197,'.................................................................................................................................................................');
$pdf->SetFont('Arial','B',10);
$pdf->text(10,203,utf8_decode('Controles en la estación de Servicio: '));
$pdf->SetFont('Arial','',10);
$pdf->text(73,203,'Antes de proceder a la descarga del combustible transportado y en presencia ');
$pdf->text(10,207,'del transportista, el Operador de la Estacion de Servicio debe:');
$pdf->text(10,211,utf8_decode('1. Verificar si las medidas marcadas en el dispositivo de referencia del camión cisterna corresponden a las anotadas'));
$pdf->text(10,215,utf8_decode('en el respectivo certificado de verificación de camiones tanque.'));
$pdf->text(10,219,utf8_decode('2. Verificar la correcta aplicación de los precintos cuyos números se hallan anotados en esta Nota de Remisión.'));
$pdf->text(10,223,utf8_decode('3. Cortar las cuerdas de amarre para devolver los precintos en buenas condiciones con ésta Nota de Remisión, por '));
$pdf->text(10,227,utf8_decode('intermedio del chofer transportista, a los funcionarios del INTN destacados en las oficinas correspondientes.'));
$pdf->text(10,231,utf8_decode('4. Verificar los niveles de combustible de cada compartimietno por medio de l dispositivo de referencia.'));
$pdf->text(10,235,utf8_decode('Nota: La estación de servicio a través del operador es responsable del cumplimineto de los ítems arriba citados.'));
$pdf->SetFont('Arial','B',10);
$pdf->text(40,239,utf8_decode('Conformidad del Operador Receptor del Combustible por cada Compartimento'));
$pdf->SetFont('Arial','',8);
$pdf->SetXY(10,240);
$pdf->Cell(25,7,'Compart. 1',1,0,'C',10);
$pdf->Cell(25,7,'Compart. 2',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 3',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 4',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 5',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 6',1,0,'C',50);
$pdf->Cell(25,7,'Compart. 7',1,1,'C',50);
$pdf->Cell(25,20,'',1,0,'C',10);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,0,'C',50);
$pdf->Cell(25,20,'',1,1,'C',50);
//---------------------------Ultima parte---------------------------------------
$pdf->text(10,270,utf8_decode('La conformidad debe ser hecha mediante firma, aclaración, fecha y sello de la Estación de Servicios. En caso que hubiese'));
$pdf->text(10,273,utf8_decode('observaciones se pueden ampliar abajo.'));
$pdf->SetFont('Arial','B',10);
$pdf->text(10,278,utf8_decode('OBSERVACIÓN:'));
$pdf->SetFont('Arial','',10);
$pdf->text(40,278,'....................................................................................................................................................');
$pdf->text(10,282,'..................................................................................................................................................................................');
$pdf->text(10,286,'..................................................................................................................................................................................');
$pdf->Output("Precintado_".$codPago,"I");
$pdf->Close();

  function get_CantidadLetras($m) { 
        switch ($m) { 
         case '1': $cant_text = "Uno"; break; 
         case '2': $cant_text = "Dos"; break; 
         case '3': $cant_text = "Tres"; break; 
         case '4': $cant_text = "Cuatro"; break; 
         case '5': $cant_text = "Cinco"; break; 
         case '6': $cant_text = "Seis"; break; 
         case '7': $cant_text = "Siete"; break; 
         case '8': $cant_text = "Ocho"; break; 
         case '9': $cant_text = "Nueve"; break; 
         case '10': $cant_text = "Diez"; break; 
         case '11': $cant_text = "Once"; break; 
         case '12': $cant_text = "Doce"; break;
         case '13': $cant_text = "Trece"; break; 
         case '14': $cant_text = "Catorce"; break; 
         case '15': $cant_text = "Quince"; break; 
         case '16': $cant_text = "Dieciseis"; break; 
         case '17': $cant_text = "Diecisiete"; break; 
         case '18': $cant_text = "Dieciocho"; break; 
         case '19': $cant_text = "Diecinueve"; break; 
         case '20': $cant_text = "Veinte"; break; 
         case '21': $cant_text = "Veintiuno"; break; 
        } 
        return ($cant_text); 
       } 