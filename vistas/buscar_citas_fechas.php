<?php

$fecha = $_POST['fecha'];

include_once('../control/conexion.php');
$buscarCitas="SELECT * FROM  cita_cnslt
 INNER JOIN motivo mot on (cita_cnslt.mot_cod = mot.mot_cod)    
 INNER JOIN pacnt_cnslt ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) 
 WHERE fecha_cita =to_date('$fecha','dd-mm-yyyy')";
$conectando = new Conection();

$listaCitas = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$resul = pg_fetch_all($listaCitas);
$table ='';
if ($resul) {
	foreach ($resul as  $cita) {
			$table.= '<tr>';
				$table.='<td>'. strftime("%Y-%m-%d",strtotime($cita["fecha_cita"])) .'</td>';
				if ($cita['estatus'] == 0) {
					$table.='<td><span class="label label-default">En Espera</span></td>';
				} else {
					$table.='<td><span class="label label-success">Realizada</span></td>';
				}
				
				$table.='<td>'. $cita["nom_pacnt"] .' '. $cita["apel_pacnt"] .'</td>';
				$table.='<td>'. $cita["ci_pacnt"] .'</td>';
				$table.='<td>'. $cita["mot_des"] .'</td>';
				$table.='<td>'. $cita["acmp_cita"] .'</td>';
				$table.='<td><div class="btn-group btn-group-sm">
							<a href="#" class="btn btn-info ver_cita" data-id="'.$cita['id_cita'].'"  data-title= "'.$cita['nom_pacnt'].' '.$cita['apel_pacnt'].'" title="Ver"><i class="icon-eye-open"></i></a>';
							if ($cita['estatus'] == 0  ) {//and  date('%Y-%m-%d') > $cita['fecha_cita']
								$table.=' <a href="edit_cita.php?id_cita='.$cita['id_cita'].'" class="btn btn-primary" title="Modificar"><i class="icon-pencil"></i></a>
                            			  <a href="#"  class="btn btn-success verificar" data-idcita="'.$cita['id_cita'].'" data-cipacnt="'.$cita["ci_pacnt"].'"  title="Verificar" ><i class="icon-check"></i></a>
                            			  <a href="../control/elim_cita.php?id_cita='.$cita['id_cita'].'" class="btn btn-danger"  title="Cancelar" onclick="if(confirm(\'&iquest;Esta seguro que desea Cancelar la Cita?\')) return true;  else return false;"><i class="icon-remove"></i></a>';
							}
                            
				$table.='</div></td>';
			$table.= '</tr>';

	}
	
	echo $table;
}else{
	echo json_encode(0);
}