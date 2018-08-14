<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$tra_cod = $_GET['tra_cod'];

$sql="DELETE FROM tratamiento_dental WHERE tra_cod=$tra_cod";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		print ("<script>alert('Tratamiento Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_tratamientos.php">');

	}

	else {
		print ("<script>alert('Tratamiento No Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_tratamientos.php>');
}

?>