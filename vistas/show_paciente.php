<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$id_pacnt = $_GET['id_paciente'];
 ini_set('display_errors', 'on');  //muestra los errores de php
    $buscarCitas="SELECT * FROM  pacnt_cnslt WHERE id_pacnt='$id_pacnt'";
	$conectando = new Conection();
    $i = 1;
	$listaCitas = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
	$paciente = pg_fetch_array($listaCitas);
        $edad= pg_fetch_array(pg_query($conectando->conectar(),"SELECT  date_part('year',age(fn_pacnt)) as edad FROM  pacnt_cnslt WHERE id_pacnt='$id_pacnt'"));
        
        ?>
<div class="content">
        <div id="pad-wrapper" class="form-page"> 
        		<h3>Ficha Clínica del Paciente</h3><br>
        		<a href="pacientes_shows.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a><br><br>
				<table class="table table-striped" id="documentacion">
				    <tbody>
                                        <tr>
				            <td><strong>Ficha Número:</strong></td>
				            <td colspan="5"><?php echo $paciente['id_pacnt']; ?></td>
				        </tr>
				        <tr>
				            <td><strong>Nombre:</strong></td>
				            <td colspan="5"><?php echo $paciente['nom_pacnt']; ?> <?php echo $paciente['apel_pacnt']; ?></td>
                                           
                                        </tr>

				        <tr>
				            
				            <td><strong>Cédula:</strong></td>
				            <td><?php echo $paciente['ci_pacnt']; ?></td>
				            <td><strong>Fecha de Nacimiento:</strong></td>
				            <td><?php echo strftime("%d-%m-%Y",strtotime($paciente['fn_pacnt']) ) ; ?></td>
				        </tr>

				        <tr>
				            <td><strong>Correo:</strong></td>
				            <td ><?php echo $paciente['mail_pacnt']; ?></td>
                                            <td><strong>Edad:</strong></td>
				            <td><?php echo $edad['edad']." años" ; ?></td>
				        </tr>

				        <tr>
				            <td><strong>Direccción:</strong></td>
				            <td colspan="5"><?php echo $paciente['dir_pacnt']; ?></td>
				        </tr>

				        <tr>
				            <td><strong>Teléfono:</strong></td>
				            <td><?php echo $paciente['cod_tlf_pacnt'].'-'. $paciente['tlf_pacnt']; ?></td>
				            <td><strong>Sexo:</strong></td>
				            <td colspan="3"><?php echo $paciente['sexo_pacnt']; ?></td>
				        </tr>
                                        
                                        <tr>
				            <td><strong>Antecedentes Personales:</strong></td>
				            <td><?php echo $paciente['antecedentes_personales']; ?></td>
				            
				        </tr>
                                        
                                        <tr>
				            <td><strong>Antecedentes Quirúrgicos:</strong></td>
				            <td><?php echo $paciente['antecedentes_quirurgicos']; ?></td>
				            
				        </tr>
                                        
                                        <tr>
				            <td><strong>Antecedentes Familiares:</strong></td>
				            <td><?php echo $paciente['antecedentes_familiares']; ?></td>
				           
				        </tr>
                                        
                                        <tr>
				            <td><strong>Otros Antecedentes:</strong></td>
				            <td><?php echo $paciente['antecedentes_otros']; ?></td>
				           
				        </tr>
                                        
                                        <tr>
				            <td><strong>Hábitos:</strong></td>
				            <td><?php echo $paciente['habitos']; ?></td>
				           
				        </tr>

				            </tbody>
				</table>
		</div>
</div>