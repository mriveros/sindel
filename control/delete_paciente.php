<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$id_pacnt = $_GET['id_paciente'];

$sql="DELETE FROM pacnt_cnslt WHERE id_pacnt = $id_pacnt";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		print ("<script>alert('Paciente Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php">');

	}

	else {
		print ("<script>alert('Paciente No Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php>');
}

?>