<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$esp_nom		= ucwords($_POST['esp_nom']);

$comparar="SELECT * FROM especialidad WHERE esp_nom = '$esp_nom'";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_num_rows($verifica);
	if ($localizar==0) {


		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO especialidad (esp_nom, esp_activo)
		VALUES ('$esp_nom', 't')");	

		if (!$INSERTAR) { 
		    print ("<script>alert('La especialidad no pudo ser registrada');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/especialidades.php">');
		    }

		else { 
		    print ("<script>alert('La especialidad fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_especialidades.php">');
		    }

	}

	else {
	    print ("<script>alert('La especialidad ya se encuentra registrada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/especialidades.php">');
}

?>