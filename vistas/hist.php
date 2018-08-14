<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }


?>
<?php 
        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        ini_set('display_errors', 'on');  //muestra los errores de php
        $id_paciente = $_GET['id_paciente'];
        $buscarPersonas="SELECT * 
        FROM pacnt_cnslt 
        INNER JOIN cita_cnslt 
        ON cita_cnslt.pac_cod =  pacnt_cnslt.id_pacnt 
        INNER JOIN motivo ON cita_cnslt.mot_cod=motivo.mot_cod 
        INNER JOIN hist_pacnt ON hist_pacnt.id_cita =  cita_cnslt.id_cita 
        INNER JOIN enfermedad en on en.enf_cod=hist_pacnt.enf_cod
        WHERE id_pacnt =$id_paciente";
        $conectando = new Conection();
        $query=pg_query($conectando->conectar(), $buscarPersonas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $result=pg_fetch_all($query);
        if (pg_num_rows($query) > 0) {
            
 
        
?> 
    
            <!--  main container -->
            <div class="content">

                <!-- end upper main stats -->

                <div id="pad-wrapper" class="form-page">

                    <!-- statistics chart built with jQuery Flot -->
                    <div class="row form-wrapper">
                        <!-- left column -->

                        <div class="col-md-2"></div><!--primera columna de centrado-->
                        <div id="miPagina" class="col-md-7 column"><!--segunda columna de centrado-->
        					<h2 align="center">HISTORIA CLINICA</h2><br>
                            
                            <a href="pacientes_shows.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a>
                            <a href="pdf_historia.php?id_paciente=<?php echo $result[0]['id_pacnt']; ?>" id="pdf_historia" class="btn btn-primary" <?php echo (pg_num_rows($query) > 0) ? "" : "disabled" ; ?>>
                                <i class="icon-download-alt" ></i>  Exportar
                            </a><br><br>
                            <table class="table table-condensed">
                                <tbody>
                                    <tr>
                                        <td colspan="4"><strong>Nombres y Apellidos: </strong> <?php echo $result[0]['nom_pacnt']; ?> <?php echo $result[0]['apel_pacnt']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Edad:</strong> <?php echo CalculaEdad($result[0]['fn_pacnt']); ?> años</td>
                                        <td><strong>C.I.:</strong> <?php echo $result[0]['ci_pacnt']; ?></td>
                                        <td><strong>Sexo:</strong> <?php echo $result[0]['sexo_pacnt']; ?></td>
                                        <td><strong>Tlf:</strong> <?php echo $result[0]['cod_tlf_pacnt']; ?>-<?php echo $result[0]['tlf_pacnt']; ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"><strong>Dirección:</strong> <?php echo $result[0]['dir_pacnt']; ?> </td>
                                    </tr>
                                    <tr>
                                                    <td colspan="4" align="center"><strong>Antecedentes</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Personales:</strong> <?php echo $result[0]['antecedentes_personales']; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="4" ><strong>Quirúrgicos:</strong> <?php echo $result[0]['antecedentes_quirurgicos']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Familiares:</strong> <?php echo $result[0]['antecedentes_familiares']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Otros:</strong> <?php echo $result[0]['antecedentes_otros']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="center"><strong>Hábitos Psicobiológicos</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" > <?php echo $result[0]['habitos']; ?></td>
                                                </tr>
                                </tbody>
                            </table>
                                    <?php foreach ($result as $value) { ?>
                                        <br>
                                        <table class="table table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td style="background: #858689;color: #fff;"><strong>N#H:</strong> <?php echo $value['id_his']; ?> </td>
                                                    <td colspan="4" style="background: #858689;color: #fff;"><strong>Fecha:</strong> <?php echo strftime("%d-%m-%Y",strtotime($value['fecha_cita'])); ?> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Motivo de consulta:</strong> <?php echo $value['mot_nom']; ?> </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" ><strong>Enfermedad actual:</strong> <?php echo $value['enf_nom']; ?> </td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" ><strong>PA:</strong> <?php echo $value['pa']; ?></td>
                                                     <td colspan="4" ><strong>FC:</strong> <?php echo $value['fc']; ?></td>
                                                </tr>
                                                
                                                 <tr>
                                                    <td colspan="4" ><strong>EF:</strong> <?php echo $value['ef']; ?></td>
                                                    <td colspan="4" ><strong>HR:</strong> <?php echo $value['hr']; ?></td>
                                                </tr>
                                                 <tr>
                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Diagnósticos:</strong> <?php echo $value['diagnostico']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Tratamiento:</strong> <?php echo $value['tratamiento']; ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" ><strong>Plan:</strong> <?php echo $value['plan']; ?></td>
                                                </tr>
                                                 <tr>
                                                    <td colspan="4" ><strong>Comentarios:</strong> <?php echo $value['comentarios']; ?></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    <?php } ?>  
                                
                        
                        </div>
                    
                    </div>
                </div>
            </div>
<?php 

           } else {
            print ("<script>alert('El Paciente no Tiene Historia Medica');</script>");
            print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php">');
        }
function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
?>