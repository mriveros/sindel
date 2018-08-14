<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');


$tra_cod    = $_POST['tra_cod'];
$tra_nom    = ucwords($_POST['tra_nom']);
$tra_costo    = ($_POST['tra_costo']);
if  (empty($_POST['tra_activo'])){$tra_activo='f';}else{ $tra_activo= 't';}

$modificar="UPDATE tratamiento_dental SET tra_nom = '$tra_nom',tra_costo=$tra_costo,tra_activo = '$tra_activo' WHERE tra_cod = $tra_cod";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Tratamiento Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_tratamientos.php">');

	}

	else {
		print ("<script>alert('Tratamiento No Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_tratamientos.php>');
}

?>