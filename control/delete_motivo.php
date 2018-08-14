<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$mot_cod = $_GET['mot_cod'];

$sql="DELETE FROM motivo WHERE mot_cod=$mot_cod";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BORRAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		print ("<script>alert('Motivo Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_motivos.php">');

	}

	else {
		print ("<script>alert('Motivo No Eliminado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_motivos.php>');
}

?>