<?php
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$nombre_usr   = ucwords($_POST['nombre_usr']);
$apellido_usr = ucwords($_POST['apellido_usr']);
$ci_usr       = $_POST['ci_usr'];
$login_usr    = $_POST['login_usr'];
$tipo_usr     = $_POST['tipo_usr'];
$pass_usr     = $_POST['pass_usr'];
$status_usr   = 1;

$conectando = new Conection();

$INSERTAR = pg_query($conectando->conectar(), "INSERT INTO usr_system (nombre_usr, apellido_usr, ci_usr, login_usr, tipo_usr, pass_usr, status_usr)
		VALUES ('$nombre_usr', '$apellido_usr', '$ci_usr', '$login_usr', '$tipo_usr', '$pass_usr', '$status_usr')");	

if (!$INSERTAR) { 
		    print ("<script>alert('El usuario no pudo ser registrado');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/user_create.php">');
}else { 
		    print ("<script>alert('El usuario fue registrado exitosamente');</script>");
		    print('<meta http-equiv="refresh" content="0; URL=../vistas/usuarios_show.php">');
	  }









