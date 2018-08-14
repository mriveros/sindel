<?php 

include_once('../control/conexion.php');
ini_set('display_errors', 'on');


if(isset($_POST['agregar'])){
$tra_cod= ($_POST['tratamientos']);
$id_paciente= ($_POST['id_paciente']);
$den_cod= ($_POST['den_cod']);
$tradet_costo_total= obtenerCosto($tra_cod);
$tradet_pendiente= ($tradet_costo_total - ($_POST['entrega']));
$observacion= ($_POST['observacion']);
    
    
    $conectando = new Conection();
    $INSERTAR=pg_query($conectando->conectar(), 
    "INSERT INTO tratamiento_dent_detalle(tra_cod, id_paciente, den_cod, 
        tradet_costo_total,tradet_pendiente, tradet_fechainicio,tradet_fechafin,tradet_estado, 
        tradet_obs)
    VALUES ($tra_cod, $id_paciente, $den_cod, $tradet_costo_total,$tradet_pendiente, 
            now(),now(),'t','$observacion');") or die ($INSERTAR);
    verificarEstadoTratamiento();
    if (!$INSERTAR) { 
        print ("<script>alert('Error 108:$INSERTAR');</script>");
        print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
        }
        else { 
        print ("<script>alert('Se ha registrado el Tratamiento');</script>");
        print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
    }
}
if(isset($_POST['editar'])){
    
    $tradet_pendiente=number_format(($_POST['entrega']),0,'','');
    $observacion= ($_POST['observacion']);
    $tradet_cod= ($_POST['tradet_cod']);
    
    
    $conectando = new Conection();
    $INSERTAR=pg_query($conectando->conectar(), 
    "update tratamiento_dent_detalle set tradet_pendiente=(tradet_pendiente -$tradet_pendiente), tradet_fechafin=now()
     where tradet_cod=$tradet_cod") or die ($INSERTAR);	
    verificarEstadoTratamiento($tradet_cod);
    if (!$INSERTAR) { 
        print ("<script>alert('Error 108:$INSERTAR');</script>");
        print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
        }
        else { 
        print ("<script>alert('Se ha actualizado el Tratamiento');</script>");
        print('<meta http-equiv="refresh" content="0; URL=../vistas/listas_citas.php">');
    }
}

function obtenerCosto($tra_cod)
{
    $conectando = new Conection();
    $query = "select tra_costo from tratamiento_dental where tra_cod=$tra_cod";
    $result = pg_query($conectando->conectar(),$query) or die ($query);
    $row = pg_fetch_row($result);
    return $row[0];
}
function verificarEstadoTratamiento(){
    $conectando = new Conection();
    $query = "update tratamiento_dent_detalle set tradet_estado='f' where tradet_pendiente=0";
    $result = pg_query($conectando->conectar(),$query) or die ($query);
}

?>