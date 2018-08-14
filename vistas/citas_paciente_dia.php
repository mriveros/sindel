<?php

$fecha = $_POST['fecha_cita'];
$cedula_paciente = $_POST['cedula_paciente'];

include_once('../control/conexion.php');
$sql="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) WHERE fecha_cita = '$fecha' AND ci_pacnt_cita = '$cedula_paciente'";
$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
if (pg_num_rows($query) > 0) {
	echo json_encode(1);
}else{
	echo json_encode(0);
}