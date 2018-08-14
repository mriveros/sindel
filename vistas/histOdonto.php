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
        $buscarPersonas="SELECT * FROM pacnt_cnslt 
        WHERE id_pacnt = $id_paciente";
        $conectando = new Conection();
        $query=pg_query($conectando->conectar(), $buscarPersonas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $result=pg_fetch_all($query);
        //if (pg_num_rows($query) > 0) { 
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
        					<h2 align="center">HISTORIA ODONTOLOGICA</h2><br>
                            
                            <a href="listas_citas.php" class="btn btn-default "><i class="icon-arrow-left"></i> Regresar</a>
                            <a href="histCita_Odonto.php?id_paciente=<?php echo $result[0]['id_pacnt']; ?>" id="pdf_historia" class="btn btn-primary" <?php echo (pg_num_rows($query) > 0) ? "" : "disabled" ; ?>>
                                <i class="icon-archive" ></i>  Historial
                            </a>
                            <br><br>
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
                                
                <center>                  
                        <!--DIENTES SUPERIORES --> 
                        <div><h2>Odontograma</h5></div>
                <tr>             
                <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto " title="Tercer Molar Izquierdo" onclick="asignarCodigoDent(1)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Molar Izquierdo"  onclick="asignarCodigoDent(2)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Molar Izquierdo" onclick="asignarCodigoDent(3)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Premolar Izquierdo" onclick="asignarCodigoDent(4)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Premolar Izquierdo" onclick="asignarCodigoDent(5)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Canino Izquierdo" onclick="asignarCodigoDent(6)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Lateral Izquierdo" onclick="asignarCodigoDent(7)"></span>
                </tr>
                 <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Central Izquierdo" onclick="asignarCodigoDent(8)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Central Derecho" onclick="asignarCodigoDent(9)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Lateral Derecho" onclick="asignarCodigoDent(10)"></span>
                </tr>
                 <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Canino Derecho" onclick="asignarCodigoDent(11)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Premolar Derecho" onclick="asignarCodigoDent(12)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Premolar Derecho" onclick="asignarCodigoDent(13)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Molar Derecho" onclick="asignarCodigoDent(14)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Molar Derecho" onclick="asignarCodigoDent(15)"></span>
                </tr>
                <tr>
                <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Tercer Molar Derecho" onclick="asignarCodigoDent(16)"></span>
                </tr>
                <br>
                <br>
<!--DIENTES INFERIORES-->
                <tr>
                <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Tercer Molar Izquierdo" onclick="asignarCodigoDent(17)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Molar Izquierdo" onclick="asignarCodigoDent(18)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Molar Izquierdo" onclick="asignarCodigoDent(19)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Premolar Izquierdo" onclick="asignarCodigoDent(20)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Premolar Izquierdo" onclick="asignarCodigoDent(21)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Canino Izquierdo" onclick="asignarCodigoDent(22)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Lateral Izquierdo" onclick="asignarCodigoDent(23)"></span>
                </tr>
                 <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Central Izquierdo" onclick="asignarCodigoDent(24)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Central Derecho" onclick="asignarCodigoDent(25)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Incisivo Lateral Derecho" onclick="asignarCodigoDent(26)"></span>
                </tr>
                 <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Canino Derecho" onclick="asignarCodigoDent(27)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Premolar Derecho" onclick="asignarCodigoDent(28)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Premolar Derecho" onclick="asignarCodigoDent(29)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Primer Molar Derecho" onclick="asignarCodigoDent(30)"></span>
                </tr>
                <tr>
                   <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Segundo Molar Derecho" onclick="asignarCodigoDent(31)""></span>
                </tr>
                <tr>
                <span style="background-color: #00b3ee"   class="btn btn-default verificarOdonto" title="Tercer Molar Derecho" onclick="asignarCodigoDent(32)"></span>
                </tr>

                </center>            
                                
                        
                        </div>
       <!--___________ACA PONEMOS NUESTRO DATATABLE DE TRATAMIENTOS_____________-->
                    <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <div class="row">
         <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Tratamientos Activos</h3>
            <tr>
                <th>#</th>
                <th hidden="true">Codigo</th>
                <th>Tratamiento</th>
                <th>Total</th>
                <th>Pendiente</th>
                <th hidden="true">Diente</th>
                <th hidden="true">CodigoDiente</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="tbody">

<?php	
        $sql="SELECT tradet.tradet_cod, tra.tra_nom, TO_CHAR(tradet_costo_total,'999G999G990D') as tradet_costo_total,
        TO_CHAR(tradet_pendiente,'999G999G990D') as tradet_pendiente,den.den_nom, den.den_cod 
        FROM  tratamiento_dent_detalle tradet, tratamiento_dental tra, dientes den 
        where tradet.tra_cod=tra.tra_cod
        and den.den_cod=tradet.den_cod
        and tradet_estado='t'
        and id_paciente=$id_paciente";
	$conectando = new Conection();
        $i = 1;
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        if( pg_num_rows($query) > 0 ){
        $resul = pg_fetch_all($query);
        foreach ( $resul as $value) {
?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td hidden="true"><?php echo $value['tradet_cod']; ?></td>
            <td><?php echo $value['tra_nom']; ?></td>
            <td><?php echo $value['tradet_costo_total']; ?></td>
            <td><?php echo $value['tradet_pendiente']; ?></td>
            <td hidden="true"><?php echo $value['den_nom']; ?></td>
            <td hidden="true"><?php echo $value['den_cod']; ?></td>
            <td>
                <div class="btn-group btn-group-sm">
                    <a class="btn btn-primary verificarEntrega" title="Realizar Entrega" onclick="enviarDiente(<?php echo $value['den_cod']; ?>,<?php echo $value['tradet_cod']; ?>)"><i class="icon-pencil"></i></a>
                </div>
                </td>
                </tr>   
                <?php }
                      }
                      //}
    function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }
                      ?>
                      
                </tbody>
                </table>
                </div>
            </div>

    <script type="text/javascript">
    $(document).ready(function() {
        });
    </script>
        <!--_________________ACA TERMINA NUESTRO DATATABLE______________________-->
                    </div>
                </div>
            </div>
<!--MODAL DE TRATAMIENTO ODONTOLOGICO            -->
<div id="modal_cita" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 70% !important;">
    <div class="modal-content">
        <form action="../control/agregar_tratamiento.php" method="post" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aplicar Tratamiento Dental<span id="title_cita"></span></h4>
      </div>
        <center><label id="titulodent">test</label></center>
      <div class="modal-body"  >
                <div class="row">
                    <!--CODIGO DE DIENTE-->
                    <input type="hidden" id="den_cod"name="den_cod">
                    <!--CODIGO DE PACIENTE-->
                    <input type="hidden" id="id_paciente"name="id_paciente" value="<?php echo $id_paciente; ?>">
                    <div class="col-md-8">
                        <label for="">Tratamientos</label>
                        <select name="tratamientos"  id="tratamientos" required>
                                    <?php
                                    //esto es para mostrar un select que trae datos de la BDD
                                    $query = "Select tra_cod,tra_nom from tratamiento_dental where tra_activo='t' ";
                                    $resultadoSelect = pg_query($query);
                                    while ($row = pg_fetch_row($resultadoSelect)) {
                                    echo "<option value=".$row[0].">";
                                    echo $row[1];
                                    echo "</option>";
                                    }
                                    ?>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                     <div class="col-md-6">
                        <label for="">Entrega Gs.</label>
                        <input type="number" name="entrega" id="entrega" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                        <label for="">Observación</label>
                        <textarea name="observacion" id="observacion" class="form-control" placeholder=""></textarea>
                </div>         
      </div> 
        <br><br><br>
      <div class="modal-footer">
        <input type="submit" name="agregar" class="btn btn-primary" value="Guardar">
        <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
      </div>
    </form>
  </div>
 </div> 
</div>

<!--_______________MODAL DE EDITAR TRATAMIENTO PARA ENTREGA___________________-->
<!--MODAL DE TRATAMIENTO ODONTOLOGICO            -->
<div id="modal_entrega" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width: 40% !important;">
    <div class="modal-content">
        <form action="../control/agregar_tratamiento.php" method="post" accept-charset="utf-8">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aplicar Tratamiento Dental<span id="title_cita"></span></h4>
      </div>
            <center><label id="titulodent2">test</label></center>
      <div class="modal-body"  >
                <div class="row">
                    <!--CODIGO DE DETALLE-->
                     <input type="hidden" id="tradet_cod"name="tradet_cod">
                    <!--CODIGO DE DIENTE-->
                    <input type="hidden" id="den_cod"name="den_cod">
                    <!--CODIGO DE PACIENTE-->
                    <input type="hidden" id="id_paciente"name="id_paciente" value="<?php echo $id_paciente; ?>">
                </div><br>
                <div class="row">
                     <div class="col-md-6">
                        <label for="">Entrega Gs.</label>
                        <input type="text" name="entrega" id="entrega" class="form-control" required="true">
                    </div>
                </div>
                <div class="col-md-6">
                        <label for="">Observación</label>
                        <textarea name="observacion" id="observacion" class="form-control" placeholder=""></textarea>
                </div>         
      </div> 
        <br><br><br>
      <div class="modal-footer">
        <input type="submit" name="editar" class="btn btn-primary" value="Guardar">
        <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
      </div>
    </form>
  </div>
 </div> 
</div>
<!--_______________FIN DE MODAL DE EDITAR TRATAMIENTO PARA ENTREGA_____________-->




    <script>
            function asignarCodigoDent(codigoDent){
                var nombreDiente=tituloDiente(codigoDent);
                document.getElementById('titulodent').innerHTML = nombreDiente;
                document.getElementById('den_cod').value = codigoDent;
                var result=confirm("Aplicar tratamiento a: ".concat(nombreDiente) );
                if(result==false){
		location.reload(); 
                }
            }
        $(".verificarOdonto").click(function(e) {
         e.preventDefault();
                $("#id_cita").val($(this).data('idcita'));
                $("#ci_pacnt").val($(this).data('cipacnt'));
                $("#modal_cita").modal();
            });
            
        $(".verificarEntrega").click(function(e) {
         e.preventDefault();
                $("#id_cita").val($(this).data('idcita'));
                $("#ci_pacnt").val($(this).data('cipacnt'));
                $("#modal_entrega").modal();
            });
            function enviarDiente(codigoDent,codigoTratamiento){
            document.getElementById('titulodent2').innerHTML = tituloDiente(codigoDent);
            document.getElementById('tradet_cod').value = codigoTratamiento;
            
        }
        /*
        $('input.number').keyup(function(event) {

           // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
        event.preventDefault();
        }

        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/([0-9])([0-9]{2})$/, '$1.$2')  
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",")
             ;
           });
         });*/
    </script>
