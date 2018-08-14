<?php 

include_once('conexion.php');
 
$nombre_usr   = ucwords($_POST['nombre_usr']);
$apellido_usr = ucwords($_POST['apellido_usr']);
$ci_usr       = $_POST['ci_usr'];
$tipo_usr     = $_POST['tipo_usr'];
$status_usr   = $_POST['status_usr'];
$id_usr       = $_POST['id_usr'];

$modificar="UPDATE usr_system SET nombre_usr = '$nombre_usr', apellido_usr = '$apellido_usr', ci_usr = '$ci_usr', tipo_usr = $tipo_usr, status_usr = '$status_usr' WHERE id_usr = '$id_usr' ";

$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $modificar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

$localizar=pg_affected_rows($verifica);
	if ($localizar > 0) {


		print ("<script>alert('Usuario Modificado');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/usuarios_show.php">');

	}

	else {
		print ("<script>alert('Usuario No Modificad');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/usuarios_show.php>');
}

?>