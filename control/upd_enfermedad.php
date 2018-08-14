<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');


$enf_cod    = $_POST['enf_cod'];
$enf_nom    = ucwords($_POST['enf_nom']);
$enf_des    = ucwords($_POST['enf_des']);
$enf_sintomas    = ucwords($_POST['enf_sintomas']);
if  (empty($_POST['enf_activo'])){$enf_activo='f';}else{ $enf_activo= 't';}

$modificar="UPDATE enfermedad SET enf_nom = '$enf_nom',enf_des = '$enf_des',enf_sintomas = '$enf_sintomas',   enf_activo = '$enf_activo' WHERE enf_cod = $enf_cod";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Enfermedad Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_enfermedades.php">');

	}

	else {
            print ("<script>alert('Enfermedad No Modificada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_enfermedades.php>');
}

?>