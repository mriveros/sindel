<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');


$mot_cod    = $_POST['mot_cod'];
$mot_nom    = ucwords($_POST['mot_nom']);
$mot_des    = ucwords($_POST['mot_des']);
if  (empty($_POST['mot_activo'])){$mot_activo='f';}else{ $mot_activo= 't';}

$modificar="UPDATE motivo SET mot_nom = '$mot_nom',mot_des='$mot_des',mot_activo = '$mot_activo' WHERE mot_cod = $mot_cod";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Motivo Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_motivos.php">');

	}

	else {
		print ("<script>alert('Motivo No Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_motivos.php>');
}

?>