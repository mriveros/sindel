<?php 
include_once('reportes/Reportes_pdf.php');
ini_set('display_errors', 'on');  //muestra los errores de php
$CONECTAR="host='localhost' dbname='consulta' user='postgres' password='postgres'";
$CONEXION=pg_connect($CONECTAR);
$id_paciente = $_GET['id_paciente'];

$sql= "SELECT * FROM pacnt_cnslt pac
INNER JOIN cita_cnslt cc ON cc.pac_cod =  pac.id_pacnt 
INNER JOIN motivo mot ON cc.mot_cod=mot.mot_cod
INNER JOIN hist_pacnt hp ON hp.id_cita =  cc.id_cita
INNER JOIN enfermedad enf ON hp.enf_cod=enf.enf_cod  WHERE pac.id_pacnt = $id_paciente";
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
                                     <tr>
                                                    <td colspan="4" align="center"><strong>Antecedentes</strong></td>
                                    </tr>
                                    <tr>
                                               <td colspan="4" ><strong>Personales:</strong> '.$result[0]['antecedentes_personales'].'</td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="4" ><strong>Quirúrgicos:</strong> '.$result[0]['antecedentes_quirurgicos'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Familiares:</strong> '.$result[0]['antecedentes_familiares'].'</td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" ><strong>Otros:</strong> '.$result[0]['antecedentes_otros'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="center"><strong>Hábitos Psicobiológicos</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" > '.$result[0]['habitos'].'</td>
                                                </tr>
                                                
                                </tbody>
                            </table>
';

$resul = pg_fetch_all($query);
	foreach ($resul as $value) {
	$html.='
		<br><br>
                                        <table id="data" border="1" class="table table" id="table_citas" cellpadding="2" cellspacing="2" >
                                            <tbody>
                                                <tr>
                                                    <td ><strong>N#H:</strong>'.$value['id_his'].'</td>
                                                    <td colspan="3" ><strong>Fecha:</strong>'.strftime("%d-%m-%Y",strtotime($value['fecha_cita'])).'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Motivo de consulta:</strong>'.$value['mot_nom'].'</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" ><strong>Enfermedad actual:</strong> '.$value['enf_nom'].'</td>
                                                </tr>
                                               <tr>
                                                    <td colspan="4" ><strong>PA:</strong> <?php echo '.$value['pa'].'</td>
                                                     <td colspan="4" ><strong>FC:</strong> <?php echo '.$value['fc'].'</td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td colspan="4" ><strong>EF:</strong> <?php echo '.$value['ef'].'</td>
                                                    <td colspan="4" ><strong>HR:</strong> <?php echo '.$value['hr'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Diagnósticos:</strong> '.$value['diagnostico'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Tratamiento:</strong>  '.$value['tratamiento'].'</td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" ><strong>Plan:</strong>  '.$value['plan'].'</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Comentarios:</strong> '.$value['comentarios'].'</td>
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