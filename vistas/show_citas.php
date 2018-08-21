<?php

session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
    include_once('../control/conexion.php');
    include_once('sidebar.php');
    include_once('script.php');
    $id_cita = $_GET['id_cita'];
	$buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt ON (cita_cnslt.pac_cod = pacnt_cnslt.id_pacnt)
    INNER JOIN motivo mot  on mot.mot_cod = cita_cnslt.mot_cod  WHERE id_cita = $id_cita";
	$conectando = new Conection();

	$sql = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());

	if( pg_num_rows($sql) > 0 ){
		$cita = pg_fetch_array($sql);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Datos de la Cita</h3><br>
        <a href="listas_citas.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
        <table class="table table-striped" id="documentacion"> 
        	<thead>
        		<tr>
                <th>Fecha Cita</th>
                <th>Paciente</th>
                <th>Cedula</th>
                <th>Motivo</th>
                <th>Acompañante</th>
                </tr>
        	</thead>
        	<tbody>
        		<tr>
                    <td><?php echo $cita['fecha_cita']; ?></td>
                    <td><?php echo $cita['nom_pacnt']; ?> <?php echo $cita['apel_pacnt']; ?></td>
                    <td><?php echo $cita['ci_pacnt']; ?></td>
                    <td><?php echo $cita['mot_des']; ?></td>
                    <td><?php echo $cita['acmp_cita']; ?></td>
                    
                </tr>
        	</tbody>
        </table>
        </div>
</div>
<?php
	}else{
			print ("<script>alert('No tiene Cita');</script>");
	}
?>

