<?php  //modulo de session
   /* 
    $variable= $_GET["retorno"];
    if ($variable=='true')
    {
        print ('<script> $("#modal_hitoria").modal(); </script>');
        print ('<script> $("#verificar_cita").trigger("click"); </script>');
        print ('<script> alert("gayer"); </script>');
    }    
    */ 
    
    session_start();
    $usuario = $_SESSION['usuario'];
    $ci_medic= $_SESSION['ci'];
    $user_tipo=$_SESSION['tipo'];  
    $especialidad=$_SESSION['especialidad'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
    include_once('../control/conexion.php');
    include_once('sidebar.php');
    include_once('script.php');
    $date = date('Y-m-d');
    ini_set('display_errors', 'on');  //muestra los errores de php
    if  ($user_tipo==1 or $user_tipo==2){
    $buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt 
    ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) 
    INNER JOIN motivo 
    ON (motivo.mot_cod = cita_cnslt.mot_cod)
    INNER JOIN medic_cnslt 
    ON (cita_cnslt.id_medic = medic_cnslt.id_medic) 
    WHERE fecha_cita='$date'  order by estatus asc";
    }else 
    $buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt 
    ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) 
    INNER JOIN motivo 
    ON (motivo.mot_cod = cita_cnslt.mot_cod)
    INNER JOIN medic_cnslt 
    ON (cita_cnslt.id_medic = medic_cnslt.id_medic and medic_cnslt.ci_medic='$ci_medic') 
    WHERE fecha_cita='$date'  order by estatus asc";
	$conectando = new Conection();
	$listaCitas = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
?>
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Historiales de citas</h3><br>
        <div class="row">
            <div class="col col-md-4">
                <label>Fecha:</label>
                           
                                <input name="fecha_cita" id="fecha_cita" class="form-control" type="text" placeholder="Click Aqui" required autocomplete="off">

                                        <script type="text/javascript">
                                         
                                          Calendar.setup(
                                            {
                                          inputField : "fecha_cita",
                                          ifFormat   : "%d-%m-%Y",
                                          //button     : "Image1"
                                            }
                                          );
                                        $("#fecha_cita").keypress(function(e) {
                                           return false;
                                        });
                                        </script>
            </div>
            <div class="col col-md-4">
                <label for=""></label><br>
                <input type="button" class="btn btn-primary" id="buscarCita" value="Buscar">
            </div>
                            
                                    

                                                    
        </div>
        <br>
        <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <tr>
                <th>Fecha Cita</th>
                <th>Estado</th>
                <th>Paciente</th>
                <th>Profesional</th>
                <th>Motivo</th>
                <th>Acompañante</th>                
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="tbody">

<?php	if( pg_num_rows($listaCitas) > 0 ){

        $resul = pg_fetch_all($listaCitas);
            foreach ( $resul as $value) {
?>
                <tr>
                    <td><?php echo strftime("%d-%m-%Y",strtotime($value['fecha_cita'])); ?></td>
                    <td>
                            <?php
                                if ($value['estatus'] == 0) {
                                    echo "<span class='label label-default'>En Espera</span>";
                                }else{
                                    echo "<span class='label label-success'>Realizada</span>";
                                }
                            ?>
                    </td>
                    <td><?php echo $value['nom_pacnt']; ?> <?php echo $value['apel_pacnt']; ?></td>
                    <td><?php echo $value['nom_medic']; ?> <?php echo $value['apel_medic']; ?></td>
                    <td><?php echo $value['mot_nom']; ?></td>
                    <td><?php echo $value['acmp_cita']; ?></td>                    
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="show_citas.php?id_cita=<?php echo $value['id_cita']; ?>" class="btn btn-info ver_cita" data-id="<?php echo $value['id_cita']; ?>"  data-title= "<?php echo $value['nom_pacnt']; ?> <?php echo $value['apel_pacnt']; ?>" title="Ver"><i class="icon-eye-open"></i></a>
                            <?php if ($value['estatus'] == 0) {
                               
                            ?>
                            <a href="edit_cita.php?id_cita=<?php echo $value['id_cita']; ?>" class="btn btn-primary" title="Modificar"><i class="icon-pencil"></i></a>
                            
                              <?php 
                              if ($_SESSION['tipo'] == 1 or $_SESSION['tipo'] == 3) {
                              ?>
                            <a id="verificar_cita" name="verificar_cita" href="#" class="btn btn-success verificar"  title="Verificar"  data-idcita="<?php echo $value['id_cita']; ?>" data-cipacnt="<?php echo $value['ci_pacnt']; ?>" ><i class="icon-check"></i></a>
                            <!--Verificar si es un odontologo Desplegar el modulo de Odontologia-->
                                    <?php 
                                      if ($especialidad== "Odontología") {
                                      ?>
                                    <a href="histOdonto.php?id_paciente=<?php echo $value['id_pacnt'];?>" class="btn btn-success"  title="Odontograma"><i class="icon-bar-chart"></i></a>
                                    <?php
                                    } ?>
                            <a href="histCita.php?id_paciente=<?php echo $value['id_pacnt'];?>" class="btn btn-success"  title="Historia"><i class="icon-list-alt"></i></a>
                            <?php
                            }
                            ?>
                            
                           
                            <!-- <a href="#" class="btn btn-default" title="Mover"><i class="icon-forward"></i></a> -->
                            <a href="../control/elim_cita.php?id_cita=<?php echo $value['id_cita']; ?>" class="btn btn-danger"  title="Cancelar" onclick="if(confirm('&iquest;Esta seguro que desea Cancelar la Cita?')) return true;  else return false;"><i class="icon-remove"></i></a>
                            <?php } ?>
                        </div>
                    </td>
                </tr>   
<?php   
            }
    }else{ ?>
        <!-- <tr>    
            <td colspan="7">No hay Registros</td>
        </tr> -->
<?php    }
	
include_once('modal.php');

?> 
        </tbody>
        </table>
</div>
</div>

<script type="text/javascript">
    $("#buscarCita").click(function(e) {
        if ( $("#fecha_cita").val() =="" ) {
            alert("El campo fecha no debe estar vacío!.");
            $("#fecha_cita").focus();
        }else{
                $.ajax({
                    url: "buscar_citas_fechas.php",
                    type : 'POST',
                    data: { fecha : $("#fecha_cita").val() },
                    success:
                        function (data) {
                            if (data == 0) {
                                alert("No se encuentran Citas para esa Fecha!.");
                            }else{
                                 $("#tbody").html(data);
                                 $(".ver_cita").click(function(e) {
                                        e.preventDefault();
                                        $("#modal_cita").modal();
                                        $("#title_cita").text($(this).data('title'));
                                        var id_cita = $(this).data('id');
                                        $.ajax({
                                                        url: "buscar_cita.php",
                                                        type : 'POST',
                                                        data: { id_cita : id_cita },
                                                        success:
                                                            function (data) {                                   
                                                               $("#modal_body_cita").html(data);                               
                                                            }
                                        });
                                 });
                                    
                                $(".verificaras").click(function(e) {
                                    e.preventDefault();
                                    $("#id_cita").val($(this).data('idcita'));
                                    $("#ci_pacnt").val($(this).data('cipacnt'));
                                    $("#modal_hitoria").modal();
                                });
                            }
                           
                        }
                });
        }    
    });

    $(".verificar").click(function(e) {
         e.preventDefault();
        $("#id_cita").val($(this).data('idcita'));
        $("#ci_pacnt").val($(this).data('cipacnt'));
        $("#modal_hitoria").modal();
    });
    
    $(".verificarOdonto").click(function(e) {
         e.preventDefault();
        $("#id_cita").val($(this).data('idcita'));
        $("#ci_pacnt").val($(this).data('cipacnt'));
        $("#modal_hitoria_odonto").modal();
    });


</script>