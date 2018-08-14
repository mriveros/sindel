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
        $buscarPersonas="SELECT * FROM pacnt_cnslt  WHERE id_pacnt = $id_paciente";
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
        					<h2 align="center">HISTORIA ODONTOLÓGICA</h2><br>
                            
                            <a href="listas_citas.php" class="btn btn-default"><i class="icon-arrow-left"></i> Regresar</a>
                            <a href="pdf_historia_Odonto.php?id_paciente=<?php echo $result[0]['id_pacnt']; ?>" id="pdf_historia" class="btn btn-primary" <?php echo (pg_num_rows($query) > 0) ? "" : "disabled" ; ?>>
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
                                </tbody>
                            </table>
                            <?php }
                            $buscarPersonas="select pac.id_pacnt,tra.tra_nom, den.den_nom, tradet.tradet_fechainicio, tradet.tradet_fechafin,tradet.tradet_obs,tradet.tradet_estado 
                            from pacnt_cnslt pac,tratamiento_dental tra, tratamiento_dent_detalle tradet, dientes den
                            where pac.id_pacnt=tradet.id_paciente
                            and tra.tra_cod=tradet.tra_cod
                            and den.den_cod=tradet.den_cod
                            and pac.id_pacnt= $id_paciente";
                            $conectando = new Conection();
                            $query=pg_query($conectando->conectar(), $buscarPersonas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
                            $result=pg_fetch_all($query);
                            if (pg_num_rows($query) > 0) { 
                            
                            ?>  
                                    <?php foreach ($result as $value) { ?>
                                        <br>
                                        <table class="table table-condensed">
                                            <tbody>
                                                <tr>
                                                    <td style="background: #858689;color: #fff;"><strong>N#H:</strong>  </td>
                                                    <td colspan="3" style="background: #858689;color: #fff;"><strong>Fecha Inicio:</strong> <?php echo strftime("%d/%m/%Y",strtotime($value['tradet_fechainicio'])); ?> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Diente:</strong> <?php echo $value['den_nom']; ?> </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" ><strong>Tratamiento:</strong> <?php echo $value['tra_nom']; ?> </td>
                                                </tr>
                                                <tr>
<!--                                                    <td colspan="4" align="center"><strong>Antecedentes</strong></td>-->
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Observaciones:</strong> <?php echo $value['tradet_obs']; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td colspan="4" ><strong>Última Visita:</strong> <?php echo strftime("%d/%m/%Y",strtotime($value['tradet_fechafin'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" ><strong>Estado:</strong> <?php  if ($value['tradet_estado']=='f'){echo 'Terminado';}else{echo 'Pendiente';}; ?></td>
                                                </tr>
                                            </tbody>
                                    </table>
                                    <?php }}else{
                                        print ("<script>alert('El Paciente no Tiene Historia Medica Odontológica');</script>");
                                        print('<meta http-equiv="refresh" content="0; URL=../vistas/pacientes_shows.php">');
                                    } ?>  
                                
                        
                        </div>
                    
                    </div>
                </div>
            </div>
<?php
function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
?>