<?php 
include_once('../control/conexion.php');
include_once('../control/conexion.php');
include_once('../vistas/script.php');
ini_set('display_errors', 'on');
$id_cita = $_GET["id_cita"];

    $borrar="DELETE FROM cita_cnslt WHERE id_cita = $id_cita";
    $conectando = new Conection();

    $verifica = pg_query($conectando->conectar(), $borrar) or die('ERROR conexion: '.pg_last_error());
    $localizar=pg_num_rows($verifica);

    if ($localizar = 1){
      print ("<script>swal('La cita fue Eliminada');location.href = '../vistas/listas_citas.php' </script>");
      
    }

    else{
            print ("<script>swal('Not Found!');</script>");
            print('<meta http-equiv="refresh" content="0; URL=listas_citas.php">');

}

?>