<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
    include_once('../control/conexion.php');
    ini_set('display_errors', 'on');  //muestra los errores de php
    
	$id_cita = $_POST['id_cita'];
    $sql="SELECT * FROM hist_cnslt   
            WHERE id_cita = '$id_cita'";
	$conectando = new Conection();

	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $cita = pg_fetch_array($query);
    
?>
<div class="row">
    <div class="col-md-6">
       <label for="">Cedula Paciente</label>
            <?php echo $cita['ci_pacnt']; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <label for="">Fecha Cita</label>
            <?php echo strftime("%d-%m-%Y",strtotime($cita['fecha_cita'])); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <label for="">Estado</label>
           <?php
                if ($cita['estatus'] == 0) {
                    echo "<span class='label label-default'>En Espera</span>";
                }else{
                    echo "<span class='label label-success'>Realizada</span>";
                }
            ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <label for="">Motivo</label>
            <?php echo $cita['mot_nom']; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <label for="">Acompañante</label>
            <?php echo $cita['acmp_cita']; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
       <label for="">Observación</label>
           <?php  echo $cita['observacion_cita']; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
       <label for="">Pago</label>
           <?php
                if ($cita['pago_cita'] == '') {
                    echo "<span class='label label-default'>Por Cancelar</span>";
                }else{
                    echo "<span class='label label-success'>Cancelado</span>";
                }
            ?>
    </div>
</div>
