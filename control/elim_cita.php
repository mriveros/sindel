<?php 
include_once('../control/conexion.php');
ini_set('display_errors', 'on');
$id_cita = $_GET["id_cita"];

    $borrar="DELETE FROM cita_cnslt WHERE id_cita = $id_cita";
    $conectando = new Conection();

    $verifica = pg_query($conectando->conectar(), $borrar) or die('ERROR conexion: '.pg_last_error());
    $localizar=pg_num_rows($verifica);

    if ($localizar = 1){
      print ("<script>alert('La cita fue Eliminada');</script>");
      print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
    }

    else{
            print ("<script>alert('Not Found!');</script>");
            print('<meta http-equiv="refresh" content="0; URL=listas_citas.php">');

}

?>