<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$mot_cod = $_GET['mot_cod'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  motivo WHERE mot_activo='t' and mot_cod=$mot_cod";
	$conectando = new Conection();
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$motivo = pg_fetch_array($query);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Datos de Motivo</h3><br>
        		<a href="index_motivos.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
				        <tr>
				            <td><strong>Motivo:</strong></td>
				            <td colspan="5"><?php echo $motivo['mot_nom']; ?></td>
				        </tr>
                                        <tr>
				            <td><strong>Descripción:</strong></td>
				            <td colspan="5"><?php echo $motivo['mot_des']; ?></td>
				        </tr>
				        <tr>
				        	<td><strong>Estado:</strong></td>
                                            <td colspan="3"><?php if ($motivo['mot_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>
				        </tr>
				            </tbody>
				</table>
		</div>
</div>
     
     
    
     
     

     
     