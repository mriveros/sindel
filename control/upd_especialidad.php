<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');


$esp_cod    = $_POST['esp_cod'];
$esp_nom    = ucwords($_POST['esp_nom']);
if  (empty($_POST['esp_activo'])){$esp_activo='f';}else{ $esp_activo= 't';}

$modificar="UPDATE especialidad SET esp_nom = '$esp_nom', esp_activo = '$esp_activo' WHERE esp_cod = $esp_cod";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Especialidad Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_especialidades.php">');

	}

	else {
		print ("<script>alert('Especialidad No Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_especialidades.php>');
}

?>