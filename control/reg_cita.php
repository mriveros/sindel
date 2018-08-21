<?php 

include_once('conexion.php');
 
ini_set('display_errors', 'on');


$id_pacnt	  = $_POST['id_pacnt'];
$fecha_cita       = $_POST['fecha_cita'];
$motivo_cita	  = $_POST['motivo_cita'];
$acmp_cita        = $_POST['acmp_cita'];
$observacion_cita = $_POST['observacion_cita'];
$med_cod          = $_POST['med_cod'];

$conectando = new Conection();
$sql="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt ON (cita_cnslt.pac_cod = pacnt_cnslt.id_pacnt) WHERE fecha_cita = to_date('$fecha_cita','dd-mm-yyyy') AND pac_cod = $id_pacnt";
$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
if (pg_num_rows($query) > 0) {
		print ("<script>alert('El Paciente ya tiene una cita con esa fecha ".$fecha_cita." intente con otra');</script>");
		print('<meta http-equiv="refresh" content="0; URL=../vistas/citas.php">');
}else{
	$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO cita_cnslt (pac_cod, fecha_cita, mot_cod, acmp_cita, estatus,observacion_cita,id_medic)
		VALUES ($id_pacnt, to_date('$fecha_cita','dd-mm-yyyy'), '$motivo_cita', '$acmp_cita', '0','$observacion_cita',$med_cod)");	

		if (!$INSERTAR) { 
		    print ("<script>alert('La cita no pudo ser registrada');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/citas.php">');
		    }

		else { 
		    print ("<script>alert('La cita fue registrada exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
		    }
}

?>