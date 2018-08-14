<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$id_medic = $_GET['id_medic'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  medic_cnslt med, especialidad esp  WHERE med.esp_cod=esp.esp_cod and id_medic='$id_medic'";
	$conectando = new Conection();
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$medico = pg_fetch_array($query);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Datos del Medico</h3><br>
        		<a href="index_medicos.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
				        <tr>
				            <td><strong>Nombre:</strong></td>
				            <td colspan="5"><?php echo $medico['nom_medic']; ?> <?php echo $medico['apel_medic']; ?></td>
				        </tr>

				        <tr>
				        	<td><strong>Especialidad:</strong></td>
				            <td colspan="3"><?php echo $medico['esp_nom']; ?></td>
				        </tr>

				        <tr>
				            
				            <td><strong>Cedula:</strong></td>
				            <td><?php echo $medico['ci_medic']; ?></td>
				            <td><strong>Fecha de Nacimiento:</strong></td>
				            <td><?php echo strftime("%d-%m-%Y",strtotime($medico['fn_medic'])); ?></td>
				        </tr>

				        <tr>
				            <td><strong>Correo:</strong></td>
				            <td colspan="5"><?php echo $medico['mail_medic']; ?></td>
				        </tr>

				        <tr>
				            <td><strong>Direccción:</strong></td>
				            <td colspan="5"><?php echo $medico['dir_medic']; ?></td>
				        </tr>

				        <tr>
				            <td><strong>Telefono:</strong></td>
				            <td><?php echo $medico['cod_tlf'].'-'. $medico['tlf_medic']; ?></td>				            
				        </tr>
                                        <tr>
				            <td><strong>Estado:</strong></td>
				            <td><?php if ($medico['med_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>				            
				        </tr>

				            </tbody>
				</table>
		</div>
</div>
     
     
    
     
     

     
     