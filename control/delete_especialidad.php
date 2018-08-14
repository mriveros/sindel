<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$esp_cod = $_GET['esp_cod'];

$sql="DELETE FROM especialidad WHERE esp_cod=$esp_cod";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		print ("<script>alert('Especialidad Eliminada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_especialidades.php">');

	}

	else {
		print ("<script>alert('Especialidad No Eliminada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_especialidades.php>');
}

?>