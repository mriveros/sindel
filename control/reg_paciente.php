<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$ci_pacnt		= $_POST['ci_pacnt'];
$nom_pacnt		= ucwords($_POST['nom_pacnt']);
$apel_pacnt		= ucwords($_POST['apel_pacnt']);
$sexo_pacnt		= $_POST['sexo_pacnt'];
$fn_pacnt		= $_POST['fn_pacnt'];
$dir_pacnt		= $_POST['dir_pacnt'];
$mail_pacnt		= $_POST['mail_pacnt'];
$cod_tlf_pacnt	= $_POST['cod_tlf_pacnt'];
$tlf_pacnt		= $_POST['tlf_pacnt'];
$antecedentes_personales    = $_POST['antecedentes_personales'];
$antecedentes_quirurgicos   = $_POST['antecedentes_quirurgicos'];
$antecedentes_familiares    = $_POST['antecedentes_familiares'];
$antecedentes_otros 	= $_POST['antecedentes_otros'];
$habitos		= $_POST['habitos'];


$comparar="SELECT * FROM pacnt_cnslt WHERE ci_pacnt = '$ci_pacnt'";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_num_rows($verifica);
	if ($localizar==0) {


		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO pacnt_cnslt 
                (ci_pacnt, nom_pacnt, apel_pacnt, fn_pacnt, dir_pacnt, mail_pacnt, tlf_pacnt, sexo_pacnt,cod_tlf_pacnt,status,antecedentes_personales,antecedentes_quirurgicos,antecedentes_familiares,antecedentes_otros,habitos)
		VALUES ('$ci_pacnt', '$nom_pacnt', '$apel_pacnt', '$fn_pacnt', '$dir_pacnt',
                '$mail_pacnt', '$tlf_pacnt', '$sexo_pacnt','$cod_tlf_pacnt','1','$antecedentes_personales','$antecedentes_quirurgicos','$antecedentes_familiares','$antecedentes_otros','$habitos')");	

		if (!$INSERTAR) { 
		    print ("<script>alert('El paciente no pudo ser registrado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes.php">');
		    }

		else { 
		    print ("<script>alert('El paciente fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php">');
		    }

	}

	else {
	    print ("<script>alert('El paciente ya se encuentra registrado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes.php">');
}

?>