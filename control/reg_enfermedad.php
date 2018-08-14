<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$enf_nom		= ucwords($_POST['enf_nom']);
$enf_des		= ucwords($_POST['enf_des']);
$enf_sintomas		= ucwords($_POST['enf_sintomas']);

$comparar="SELECT * FROM enfermedad WHERE enf_nom = '$enf_nom'";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_num_rows($verifica);
	if ($localizar==0) {


		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO enfermedad (enf_nom,enf_des,enf_sintomas,enf_activo)
		VALUES ('$enf_nom','$enf_des','$enf_sintomas','t')");	

		if (!$INSERTAR) { 
		    print ("<script>alert('La Enfermedad no pudo ser registrada');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/enfermedades.php">');
		    }

		else { 
		    print ("<script>alert('La Enfermedad fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_enfermedades.php">');
		    }

	}

	else {
	    print ("<script>alert('La Enfermedad ya se encuentra registrada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/enfermedades.php">');
}

?>