2<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$tra_nom		= ucwords($_POST['tra_nom']);
$tra_costo		= ucwords($_POST['tra_costo']);
$comparar="SELECT * FROM tratamiento_dental WHERE tra_nom = '$tra_nom'";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_num_rows($verifica);
	if ($localizar==0) {


		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO tratamiento_dental (tra_nom,tra_costo, tra_activo)
		VALUES ('$tra_nom','$tra_costo', 't')");	

		if (!$INSERTAR) { 
		    print ("<script>alert('El Tratamiento no pudo ser registrado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/tratamientos.php">');
		    }

		else { 
		    print ("<script>alert('El Tratamiento fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_tratamientos.php">');
		    }

	}

	else {
	    print ("<script>alert('El Tratamiento ya se encuentra registrado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/tratamientos.php">');
}

?>