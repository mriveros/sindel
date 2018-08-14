<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');

$id_cita		= $_POST['id_cita'];
$fecha_cita		= $_POST['fecha_cita'];
$motivo_cita	= $_POST['motivo_cita'];
$acmp_cita		= $_POST['acmp_cita'];
$observacion_cita = $_POST['observacion_cita'];
$med_cod          = $_POST['med_cod'];

$modificar="UPDATE cita_cnslt SET fecha_cita = '$fecha_cita', mot_cod = '$motivo_cita', acmp_cita = '$acmp_cita', observacion_cita = '$observacion_cita',id_medic=$med_cod WHERE id_cita = $id_cita";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Cita Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');

	}

	else {
		print ("<script>alert('Cita No Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php>');
}

?>