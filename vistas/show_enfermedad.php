<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$enf_cod = $_GET['enf_cod'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $sql="SELECT * FROM  enfermedad WHERE enf_cod=$enf_cod";
	$conectando = new Conection();
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$enfermedad = pg_fetch_array($query);
?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Datos de Especialidad</h3><br>
        		<a href="index_enfermedades.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
				        <tr>
				            <td><strong>Enfermedad:</strong></td>
				            <td colspan="5"><?php echo $enfermedad['enf_nom']; ?></td>
				        </tr>
                                        
                                        <tr>
				            <td><strong>Descripción:</strong></td>
				            <td colspan="5"><?php echo $enfermedad['enf_des']; ?></td>
				        </tr>
                                        <tr>
				            <td><strong>Síntomas:</strong></td>
				            <td colspan="5"><?php echo $enfermedad['enf_sintomas']; ?></td>
				        </tr>

				        <tr>
				        	<td><strong>Estado:</strong></td>
                                            <td colspan="3"><?php if ($enfermedad['enf_activo']=='t'){echo "Activo";}else echo"Inactivo"; ?></td>
				        </tr>
				            </tbody>
				</table>
		</div>
</div>
     
     
    
     
     

     
     