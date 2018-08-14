<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$mot_nom		= ucwords($_POST['mot_nom']);
$mot_des		= ucwords($_POST['mot_des']);
$comparar="SELECT * FROM motivo WHERE mot_nom = '$mot_nom'";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_num_rows($verifica);
	if ($localizar==0) {


		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO motivo (mot_nom,mot_des, mot_activo)
		VALUES ('$mot_nom','$mot_des', 't')");	

		if (!$INSERTAR) { 
		    print ("<script>alert('El motivo no pudo ser registrado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/motivos.php">');
		    }

		else { 
		    print ("<script>alert('El motivo fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_motivos.php">');
		    }

	}

	else {
	    print ("<script>alert('El motivo ya se encuentra registrado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/motivos.php">');
}

?>