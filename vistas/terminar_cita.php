<?php 
include_once('../control/conexion.php');
include_once('../config/config.php');


$id_cita                  = $_POST['id_cita'];
$id_pacnt                 = $_POST['id_pacnt'];

$enfermedad_actual        = $_POST['enf_cod'];
$diagnostico              = $_POST['diagnostico'];
$tratamiento              = $_POST['tratamiento'];
$plan                     = $_POST['plan'];
$comentarios              = $_POST['comentarios'];
$pa                       = $_POST['pa'];
$fc                       = $_POST['fc'];
$ef                       = $_POST['ef'];
$hr                       = $_POST['hr'];
$precio = PRECIO_CITA;
$sql="UPDATE cita_cnslt SET pago_cita = $precio, estatus = '1'  WHERE id_cita = $id_cita";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO hist_pacnt (enf_cod, diagnostico, tratamiento,plan,comentarios, pa, fc, ef, hr, id_cita, pac_cod)
		VALUES ($enfermedad_actual, '$diagnostico', '$tratamiento','$plan','$comentarios', $pa, $fc, $ef, $hr, $id_cita, $id_pacnt)");	

		if (!$INSERTAR) { 
		    print ("<script>alert('Ocurrio un error al Procesar la Operación');</script>");
	    	print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
		    }

		else { 
		    print ("<script>alert('Cita Terminada');</script>");
	    	print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
		    }		

	}else {
		print ("<script>alert('Cita no Terminada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php>');
	}

?>