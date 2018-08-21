<?php  
    session_start();
    $usuario = $_SESSION['usuario'];
    $ci_medic= $_SESSION['ci'];
    $user_tipo=$_SESSION['tipo'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        $fecha = date('Y-m-d');
        //$buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt ON (cita_cnslt.ci_pacnt_cita = pacnt_cnslt.ci_pacnt) WHERE fecha_cita = '$fecha' AND estatus = '0' ";
        if  ($user_tipo=='1' or $user_tipo=='2'){
            $buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt 
            ON (cita_cnslt.pac_cod = pacnt_cnslt.id_pacnt) 
            INNER JOIN motivo 
            ON (motivo.mot_cod = cita_cnslt.mot_cod)
            INNER JOIN medic_cnslt 
            ON (cita_cnslt.id_medic = medic_cnslt.id_medic) 
            WHERE fecha_cita=to_date('$fecha','YYYY-MM-DD')  order by estatus asc";
            }else if ($user_tipo=='3'){
            $buscarCitas="SELECT * FROM  cita_cnslt INNER JOIN pacnt_cnslt 
            ON (cita_cnslt.pac_cod = pacnt_cnslt.id_pacnt) 
            INNER JOIN motivo 
            ON (motivo.mot_cod = cita_cnslt.mot_cod)
            INNER JOIN medic_cnslt 
            ON (cita_cnslt.id_medic = medic_cnslt.id_medic and medic_cnslt.ci_medic='$ci_medic') 
            WHERE fecha_cita=to_date('$fecha','YYYY/MM/DD') order by estatus asc";
            }
            $conectando = new Conection();

        $listaCitas = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $resul = pg_fetch_all($listaCitas);
?>  
    <div class="content">
        <div id="pad-wrapper" class="form-page logo" >
            <div class="row header">
                <h3>kitana</h3></br>
                <h4>- Sistema de Consultas -</h4>
            </div>
            <?php if (pg_num_rows($listaCitas) > 0) { ?>           
             <div class="row">
                <div class="col col-md-2">
                    <div class="alert alert-info">
                        <a  href="listas_citas.php" class="">Citas del Dia <span class="badge"><?php echo pg_num_rows($listaCitas); ?></span></a>
                    </div>                    
                </div>            
            </div>
            
            <?php } ?>
            
        </div>

    </div>
            
            
            
                       
   