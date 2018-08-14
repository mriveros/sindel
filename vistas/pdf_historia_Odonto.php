<?php 
include_once('reportes/Reportes_pdf.php');
ini_set('display_errors', 'on');  //muestra los errores de php
$CONECTAR="host='localhost' dbname='consulta' user='postgres' password='postgres'";
$CONEXION=pg_connect($CONECTAR);
$id_paciente = $_GET['id_paciente'];

$sql="select pac.id_pacnt,
    pac.nom_pacnt,pac.apel_pacnt,
    pac.sexo_pacnt,
    pac.dir_pacnt,
    pac.tlf_pacnt,
    pac.cod_tlf_pacnt,
    pac.ci_pacnt,
    pac.fn_pacnt,
    tra.tra_nom, 
    den.den_nom, 
    tradet.tradet_fechainicio, 
    tradet.tradet_fechafin,
    tradet.tradet_obs,
    tradet.tradet_estado 
    from pacnt_cnslt pac,tratamiento_dental tra, tratamiento_dent_detalle tradet, dientes den
    where pac.id_pacnt=tradet.id_paciente
    and tra.tra_cod=tradet.tra_cod
    and den.den_cod=tradet.den_cod
    and pac.id_pacnt=  $id_paciente";
$query = pg_query($CONEXION, $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$result=pg_fetch_all($query);

$html= '
							<br><h2 align="center">HISTORIA CLINICA</h2><br>
 							<table id="data" border="1" class="table table" id="table_citas" cellpadding="2" cellspacing="2" >
                                <tbody>
                                    <tr>
                                        <td colspan="4"><strong>Nombres y Apellidos: </strong>'.$result[0]['nom_pacnt'].' '.$result[0]['apel_pacnt'].'</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Edad:</strong>'.CalculaEdad($result[0]['fn_pacnt']).' años</td>
                                        <td><strong>C.I.:</strong> '.$result[0]['ci_pacnt'].'</td>
                                        <td><strong>Sexo:</strong> '.$result[0]['sexo_pacnt'].'</td>
                                        <td><strong>Tlf:</strong> '.$result[0]['cod_tlf_pacnt'].'-'.$result[0]['tlf_pacnt'].'</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><strong>Dirección:</strong>'.$result[0]['dir_pacnt'].'</td>
                                    </tr>
                                </tbody>
                            </table>
';

$resul = pg_fetch_all($query);
	foreach ($resul as $value) {
            if ($value['tradet_estado']=='f'){ $estado='Terminado';}else{ $estado='Pendiente';}; 
	$html.='
		<br><br>
                                        <table id="data" border="1" class="table table" id="table_citas" cellpadding="2" cellspacing="2" >
                                            <tbody>
                                                <tr>
                                                    <td ><strong>N#H:</strong>'.$value['id_pacnt'].'</td>
                                                    <td colspan="3" ><strong>Fecha:</strong>'.strftime("%d-%m-%Y",strtotime($value['tradet_fechainicio'])).'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Diente:</strong>'.$value['den_nom'].'</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" ><strong>Tratamiento:</strong> '.$value['tra_nom'].'</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="4" ><strong>Observaciones:</strong> '.$value['tradet_obs'].'</td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="4" ><strong>Ultima Visita:</strong> '.$value['tradet_fechafin'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Estado:</strong> '.$estado.'</td>
                                                </tr>
                                            </tbody>
                                    </table>
	';
}

function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

$pdf= new Reportes_pdf();
$pdf->pdf( $titulo = 'HISTORIA CLINICA', $formato = 'A4' , $orientacion = 'P' , $html, $archivo = 'histori_clinica_'.$result[0]['ci_pacnt']);

?>