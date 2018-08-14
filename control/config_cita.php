<?php
session_start();
ini_set('display_errors', 'on');  //muestra los errores de php
$id_usr = $_SESSION['id'];
include_once('conexion.php');
$conectando = new Conection();
$fecha_config = date('Y-m-d');
$status = 1;
$sql = '';
if (@$_POST['guardar_precio_cita']) {
	$tipo = 1;
	$precio = $_POST['precio_cita'];
	$sql="SELECT * FROM  config_cita WHERE status = '1' AND tipo = $tipo ";
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	
	if (pg_num_rows($query) > 0) {
		$sql="UPDATE config_cita SET status = '0' WHERE status = '1'";
		$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());		
	}
	$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO config_cita (precio_cita, tipo, fecha_config, status, id_usr)
		VALUES ('$precio', '$tipo', '$fecha_config', '$status', '$id_usr')");
	if ($INSERTAR) { 
		    print ("<script>alert('Precio Agregado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
		    }

	else { 
		    print ("<script>alert('Precio no Agregado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
	}
	exit();

		
}//FIN if ($_POST['guardar_precio_cita'])

if (@$_POST['guardar_numero_cita']) {
	$tipo = 2;
	$numero = $_POST['numero_cita'];
	$sql="SELECT * FROM  config_cita WHERE status = '1' AND tipo = $tipo ";
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	if (pg_num_rows($query) > 0) {
		$sql="UPDATE config_cita SET numero_cita = '$numero' WHERE status = '1' AND tipo = $tipo";
		$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
		if (pg_affected_rows($query) > 0) {
				print ("<script>alert('Número de Citas Agregado');</script>");
		    	print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
			} else {
				print ("<script>alert('Número de Citas no Agregado');</script>");
		    	print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
			}
				
	}else{
		$INSERTAR=pg_query($conectando->conectar(), "INSERT INTO config_cita (numero_cita, tipo, fecha_config, status, id_usr)
		VALUES ('$numero', '$tipo', '$fecha_config', '$status', '$id_usr')");
		if ($INSERTAR) {
				print ("<script>alert('Número de Citas Agregado');</script>");
		    	print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
		} else {
				print ("<script>alert('Número de Citas no Agregado');</script>");
		    	print('<meta http-equiv="refresh" content="0; URL=../vistas/config_citas.php">');
		}
		
	}
	exit();
}

