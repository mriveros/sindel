<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');


$ci_pacnt		= $_POST['ci_pacnt'];
$nom_pacnt		= ucwords($_POST['nom_pacnt']);
$apel_pacnt		= ucwords($_POST['apel_pacnt']);
$fn_pacnt		= $_POST['fn_pacnt'];
$dir_pacnt		= $_POST['dir_pacnt'];
$mail_pacnt		= $_POST['mail_pacnt'];
$tlf_pacnt		= $_POST['tlf_pacnt'];
$id_pacnt       = $_POST['id_pacnt'];
$cod_tlf_pacnt = $_POST['cod_tlf_pacnt'];
$antecedentes_personales    = $_POST['antecedentes_personales'];
$antecedentes_quirurgicos   = $_POST['antecedentes_quirurgicos'];
$antecedentes_familiares    = $_POST['antecedentes_familiares'];
$antecedentes_otros 	= $_POST['antecedentes_otros'];
$habitos		= $_POST['habitos'];

$modificar="UPDATE pacnt_cnslt SET nom_pacnt = '$nom_pacnt',
        apel_pacnt = '$apel_pacnt', fn_pacnt = '$fn_pacnt',
        dir_pacnt = '$dir_pacnt', mail_pacnt = '$mail_pacnt', tlf_pacnt = '$tlf_pacnt' ,
        cod_tlf_pacnt = '$cod_tlf_pacnt',antecedentes_personales='$antecedentes_personales',
        antecedentes_quirurgicos='$antecedentes_quirurgicos',
        antecedentes_familiares='$antecedentes_familiares', antecedentes_otros='$antecedentes_otros', 
        habitos='$habitos' WHERE ci_pacnt = $ci_pacnt";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Paciente Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php">');

	}

	else {
		print ("<script>alert('Paciente No Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php>');
}

?>