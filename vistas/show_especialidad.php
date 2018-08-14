<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$esp_cod = $_GET['esp_cod'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  especialidad WHERE esp_activo='t' and esp_cod=$esp_cod";
	$conectando = new Conection();
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$especialidad = pg_fetch_array($query);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Datos de Especialidad</h3><br>
        		<a href="index_especialidades.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
				        <tr>
				            <td><strong>Especialidad:</strong></td>
				            <td colspan="5"><?php echo $especialidad['esp_nom']; ?></td>
				        </tr>

				        <tr>
				        	<td><strong>Estado:</strong></td>
                                            <td colspan="3"><?php if ($especialidad['esp_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>
				        </tr>
				            </tbody>
				</table>
		</div>
</div>
     
     
    
     
     

     
     