<?php 
include_once('conexion.php');
 
ini_set('display_errors', 'on');

$enf_cod = $_GET['enf_cod'];

$sql="DELETE FROM enfermedad WHERE enf_cod=$enf_cod";

$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or 
        die('<script>
        alert("No se puede eliminar Enfermedad. Esta en uso.");
        window.locationf="http://localhost/voces/vistas/index_enfermedades.php";
        </script>' . pg_last_error());

	if (pg_affected_rows($query) > 0) {

            print ("<script>alert('Enfermedad Eliminada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_enfermedades.php">');

	}

	else {
	    print ("<script>alert('Enfermedad No Eliminada');</script>");
	    print('<meta http-equiv="refresh" content="0; URL=../vistas/index_enfermedades.php>');
}

?>