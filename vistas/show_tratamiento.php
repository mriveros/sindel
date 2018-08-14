<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$tra_cod = $_GET['tra_cod'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  tratamiento_dental WHERE tra_activo='t' and tra_cod=$tra_cod";
	$conectando = new Conection();
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$tratamiento = pg_fetch_array($query);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Datos de Tratamiento</h3><br>
        		<a href="index_tratamientos.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
				        <tr>
				            <td><strong>Tratamiento:</strong></td>
				            <td colspan="5"><?php echo $tratamiento['tra_nom']; ?></td>
				        </tr>
                                        <tr>
				            <td><strong>Costo:</strong></td>
				            <td colspan="5"><?php echo $tratamiento['tra_costo']; ?></td>
				        </tr>
				        <tr>
				        	<td><strong>Estado:</strong></td>
                                            <td colspan="3"><?php if ($tratamiento['tra_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>
				        </tr>
				            </tbody>
				</table>
		</div>
</div>
     
     
    
     
     

     
     