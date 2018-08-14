<?php 

include_once('../control/conexion.php');
 
ini_set('display_errors', 'on');


$sql = "SELECT nom_pacnt ||' '|| apel_pacnt as nombre_paciente,mot_nom,fecha_cita FROM  cita_cnslt INNER JOIN pacnt_cnslt 
    ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) 
    INNER JOIN motivo 
    ON (motivo.mot_cod = cita_cnslt.mot_cod)
    INNER JOIN medic_cnslt 
    ON (cita_cnslt.id_medic = medic_cnslt.id_medic) 
    WHERE fecha_cita='05-05-2017' order by estatus asc";

$conectando = new Conection();
//$result = pg_query($query) or die ("Error al realizar la consulta");
$resulset = pg_query($conectando->conectar(),$sql);
 
$arr = array();
while ($obj =pg_fetch_object($resulset)) {
    $arr[] = array('nombre_paciente' => utf8_encode($obj->nombre_paciente),
                   'mot_nom' => $obj->mot_nom,
                   'fecha_cita' => $obj->fecha_cita,
                  
        );
}
$datares = array( 'status'=>200, 'Registros'=>$arr );
echo '' . json_encode($datares) . '';
?>