<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$id_medic = $_GET['id_medic'];

$sql="update medic_cnslt set med_activo = false WHERE id_medic=$id_medic";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		print ("<script>alert('Estado de Médico Inactivo');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_medicos.php">');

	}

	else {
		print ("<script>alert('Médico No Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_medicos.php>');
}

?>