<?php 
include_once('reportes/Reportes_pdf.php');
ini_set('display_errors', 'on');  //muestra los errores de php
$CONECTAR="host='127.0.0.1' dbname='consulta' user='postgres' password='postgres'";
$CONEXION=pg_connect($CONECTAR);
$fecha = new DateTime();
$fecha->modify('first day of this month');
$first_day = $fecha->format('Y-m-d');
$fecha->modify('last day of this month');
$last_day = $fecha->format('Y-m-d');
$i = 1;
$sql="SELECT  * FROM  cita_cnslt INNER JOIN pacnt_cnslt ON (cita_cnslt.pac_cod = pacnt_cnslt.id_pacnt) INNER JOIN motivo mot ON (cita_cnslt.mot_cod = mot.mot_cod)  Where fecha_cita  BETWEEN '$first_day'  AND '$last_day'";
$query = pg_query($CONEXION, $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());


$html= '
<h3 align="center">Asistencia del Mes</h3><br>
 <table id="data" border="1" class="table table" id="table_citas" cellpadding="2" cellspacing="2" >
            <thead>
            <tr>
                <th style="font-weight: bold;" width="50">#</th>
                <th style="font-weight: bold;">Fecha Cita</th>
                <th style="font-weight: bold;">Paciente</th>
                <th style="font-weight: bold;">Cedula</th>
                <th style="font-weight: bold;">Motivo</th>
            </tr>
            </thead>
            <tbody id="tbody">
';

$resul = pg_fetch_all($query);
	foreach ($resul as $value) {
	$html.='
		<tr>
	            <td width="50">'.$i++.'</td>
	            <td>'.$value['fecha_cita'].'</td>
	            <td>'.$value['nom_pacnt'].' '.$value['apel_pacnt'].'</td>
	            <td>'.$value['ci_pacnt'].'</td>    
	            <td>'.$value['mot_des'].'</td>
	            
	    </tr>
	';
}
$html.='
		</tbody>
        </table>
';
// var_dump($html);
// die();
$pdf= new Reportes_pdf();
$pdf->pdf( $titulo = 'Reporte de Asistencia del mes', $formato = 'A4' , $orientacion = 'P' , $html, $archivo = 'reporte_asistencia_mes');

?>