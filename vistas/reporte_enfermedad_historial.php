<?php
session_start();
$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
        header("Location: ../index.php");
}
include_once('../control/conexion.php');
include_once('sidebar.php');
include_once('script.php');
$fecha = new DateTime();
$fecha->modify('first day of this month');
$first_day = $fecha->format('Y-m-d');
$fecha->modify('last day of this month');
$last_day = $fecha->format('Y-m-d');
 $i = 1;
$sql="select * from cita_cnslt cc
INNER JOIN hist_pacnt hp on cc.id_cita= hp.id_cita
INNER JOIN pacnt_cnslt pac on pac.id_pacnt = hp.pac_cod
INNER JOIN enfermedad enf on enf.enf_cod = hp.enf_cod";
$conectando = new Conection();

$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());

?>

  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Historiales Enfermedades-Pacientes</h3><br>
        <div class="row">
            <div class="col col-md-6">
                <!--a href="pdf_asistencia_mes.php" id="pdf_asistencia_mes" class="btn btn-primary" <?php echo (pg_num_rows($query) > 0) ? "" : "disabled" ; ?>>
                    <i class="icon-download-alt" ></i>  Exportar
                </a-->
                
            </div>                                                    
        </div><br><br>
        <div class="row" id="table_asistencia">
         <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <tr>
                <th>#</th>
                <th>Fecha Cita</th>
                <th>Paciente</th>
                <th>Diagnóstico</th>
                <th>Enfermedad</th>
                <th>Ver Detalle</th>  
            </tr>
            </thead>
            <tbody id="tbody">
<?php
if( pg_num_rows($query) > 0 ){
	$resul = pg_fetch_all($query);
	foreach ($resul as $value) {
?>

	 <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['fecha_cita']; ?></td>
            <td><?php echo $value['nom_pacnt']; ?> <?php echo $value['apel_pacnt']; ?></td>
            <td><?php echo $value['diagnostico']; ?></td>    
            <td><?php echo $value['enf_nom']; ?></td>
            <td><a id="verificar_cita" name="verificar_cita" href="#" class="btn btn-success verificar"  title="Verificar"  data-idcita="<?php echo $value['id_cita']; ?>" data-idpacnt="<?php echo $value['id_pacnt']; ?>" data-enfermedad="<?php echo $value['enf_nom']; ?>" 
            data-pa="<?php echo $value['pa']; ?>"   data-ef="<?php echo $value['ef']; ?>"  data-fc="<?php echo $value['fc'];?>"  data-hr="<?php echo $value['hr'];?>" 
             data-diagnostico="<?php echo $value['diagnostico']; ?>"  data-tratamiento="<?php echo $value['tratamiento'];?>"  data-plan="<?php echo $value['plan']; ?>" 
              data-comentarios="<?php echo $value['comentarios']; ?>" ><i class="icon-check"></i>Ver Detalles</a></td>
           
         </tr>  



<?php
	}
}else{
?>
	<!-- <tr>    
            <td colspan="4">No hay Registros</td>
    </tr> -->
<?php	
}
include_once('modal_historial.php');
?>
        </tbody>
        </table>
</div>
</div>

<script type="text/javascript">
     $(".verificar").click(function(e) {
         e.preventDefault();
        $("#id_cita").val($(this).data('idcita'));
        $("#id_pacnt").val($(this).data('idpacnt'));
        $("#enfermedad_actual").val($(this).data('enfermedad'));
        $("#pa").val($(this).data('pa'));
        $("#ef").val($(this).data('ef'));
        $("#fc").val($(this).data('fc'));
        $("#hr").val($(this).data('hr'));
        $("#diagnostico").val($(this).data('diagnostico'));
        $("#tratamiento").val($(this).data('tratamiento'));
        $("#plan").val($(this).data('plan'));
        $("#comentarios").val($(this).data('comentarios'));
        $("#modal_hitoria").modal();
    });
</script>