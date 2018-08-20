<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    } 
        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        $id_medic = $_GET['id_medic'];
        ini_set('display_errors', 'on');  //muestra los errores de php
        $sql="SELECT * FROM  medic_cnslt WHERE id_medic='$id_medic'";
        $conectando = new Conection();
        $query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $medico = pg_fetch_array($query);
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
                    <h2 align="center">Modificar Medico</h2></br></br>

                    <!---->
                      <form method="POST" id="editrar_medicos" action="../control/upd_medico.php" autocomplete="off">
                    

                        <div class="field-box">
                            <label>Nombre:</label>
                            <div class="col-md-7">
                                <input name="nom_medic" value="<?php echo $medico['nom_medic']; ?>" id="nom_medic" class="form-control" type="text" required type="text" autofocus>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Apellido:</label>
                            <div class="col-md-7">
                                <input name="apel_medic" value="<?php echo $medico['apel_medic']; ?>" id="apel_medic" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Cedula:</label>
                            <div class="col-md-7">
                               <input value="<?php echo $medico['ci_medic']; ?>" name="ci_medic" id="ci_medic" class="form-control" required type="text" min="00000000" max="99999999" placeholder="12345678" autofocus>
                            </div>                            
                        </div>
                        
                       <div class="field-box">
                            <label>Especialidad:</label>
                                <div class="col-md-7">
                                    <select name="espc_medic" class="form-control" id="espc_medic" required>
                                    <?php
                                    //esto es para mostrar un select que trae datos de la BDD
                                    $query = "Select esp_cod,esp_nom from especialidad where esp_activo='t' ";
                                    $resultadoSelect = pg_query($query);
                                    while ($row = pg_fetch_row($resultadoSelect)) {
                                    echo "<option value=".$row[0].">";
                                    echo $row[1];
                                    echo "</option>";
                                    }
                                    ?>
                                    </select>
                                </div>
                           </div>

                        <div class="field-box">
                            <label>Fecha de Nacimiento:</label>
                            <div class="col-md-7">
                                <input name="fn_medic" value="<?php echo strftime("%d-%m-%Y",strtotime($medico['fn_medic'])); ?>" id="fn_medic" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                          Calendar.setup(
                                            {
                                          inputField : "fn_medic",
                                          ifFormat   : "%d-%m-%Y",
                                          //button     : "Image1"
                                            }
                                          );
                                          
                                        $("#fn_medic").keypress(function(e) {
                                           return false;
                                        });
                                        </script>
                                    

                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Direccion:</label>
                            <div class="col-md-7">
                                <input type="text" name="dir_medic" value="<?php echo $medico['dir_medic']; ?>" id="dir_medic" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Correo:</label>
                            <div class="col-md-7">
                                <input type="text" name="mail_medic" value="<?php echo $medico['mail_medic']; ?>" id="mail_medic" class="form-control" placeholder="  @" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Num Telefono:</label>
                            <div class="col-md-2">
                                        <select name="cod_tlf" id="cod_tlf" class="form-control">
                                            <option value="0961" <?php if($medico['cod_tlf'] == "0961"){ echo "selected";} ?>>0961</option>
                                            <option value="0962" <?php if($medico['cod_tlf'] == "0962"){ echo "selected";} ?>>0962</option>
                                            <option value="0963" <?php if($medico['cod_tlf'] == "0963"){ echo "selected";} ?>>0963</option>
                                            <option value="0964" <?php if($medico['cod_tlf'] == "0964"){ echo "selected";} ?>>0964</option>
                                            <option value="0965" <?php if($medico['cod_tlf'] == "0965"){ echo "selected";} ?>>0965</option>
                                            <option value="0971" <?php if($medico['cod_tlf'] == "0971"){ echo "selected";} ?>>0971</option>
                                            <option value="0972" <?php if($medico['cod_tlf'] == "0972"){ echo "selected";} ?>>0972</option>
                                            <option value="0973" <?php if($medico['cod_tlf'] == "0973"){ echo "selected";} ?>>0973</option>
                                            <option value="0974" <?php if($medico['cod_tlf'] == "0974"){ echo "selected";} ?>>0974</option>
                                            <option value="0975" <?php if($medico['cod_tlf'] == "0975"){ echo "selected";} ?>>0975</option>
                                            <option value="0981" <?php if($medico['cod_tlf'] == "0981"){ echo "selected";} ?>>0981</option>
                                            <option value="0982" <?php if($medico['cod_tlf'] == "0982"){ echo "selected";} ?>>0982</option>
                                            <option value="0983" <?php if($medico['cod_tlf'] == "0983"){ echo "selected";} ?>>0983</option>
                                            <option value="0984" <?php if($medico['cod_tlf'] == "0984"){ echo "selected";} ?>>0984</option>
                                            <option value="0985" <?php if($medico['cod_tlf'] == "0985"){ echo "selected";} ?>>0985</option>
                                            <option value="0991" <?php if($medico['cod_tlf'] == "0991"){ echo "selected";} ?>>0991</option>
                                            <option value="0992" <?php if($medico['cod_tlf'] == "0992"){ echo "selected";} ?>>0992</option>
                                            <option value="0993" <?php if($medico['cod_tlf'] == "0993"){ echo "selected";} ?>>0993</option>
                                            <option value="0994" <?php if($medico['cod_tlf'] == "0994"){ echo "selected";} ?>>0994</option>
                                            <option value="0995" <?php if($medico['cod_tlf'] == "0995"){ echo "selected";} ?>>0995</option>
                                            <option value="021" <?php if($medico['cod_tlf'] == "021"){ echo "selected";} ?>>021</option>
                                        </select>
                                    </div>
                            <div class="col-md-5">
                                <input type="number" name="tlf_medic" value="<?php echo $medico['tlf_medic']; ?>" id="tlf_medic" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Estado</label>
                                <div class="col-md-7">
                                    <div class="radio">
                                    <label><input type="radio" name="med_activo" value="1" checked /> Activo</label>
                                    <label><input type="radio" name="med_activo" value="0" /> Inactivo</label>
                                    </div>
                                </div>
                            </div>   

                        
                        
                        <div class="action">
                            <input type="hidden" name="id_medic" value="<?php echo $medico['id_medic']; ?>">
                            <input type="submit"  class="btn btn-primary" id="editar" value="Editar" >
                            <a href="index_medicos.php" class="btn btn-default">Cancelar</a>
                            
                        </div> 
                        
                        
                    </form>
                </div>
            
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
            $("select").select2();
            $("#editrar_medicos").validate({
                rules: {
                    nom_medic : {
                            required: true,
                            minlength: 2
                    },
                    apel_medic : {
                            required: true,
                            minlength: 2
                    },
                    espc_medic : {
                            required: true,
                    },
                    fn_medic : {
                            required: true,
                            
                    },
                    dir_medic : {
                            required: true,
                    },
                    mail_medic : {
                            required: true,
                            email: true
                    },
                    tlf_medic : {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 10,
                    },
                },
                messages: {
                    nom_medic:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    apel_medic:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    espc_medic:{                            
                            required: 'el campo es requerido',
                    },
                    fn_medic:{                            
                            required: 'el campo es requerido',
                            
                    },
                    dir_medic:{                            
                            required: 'el campo es requerido',
                    },
                    mail_medic:{                            
                            required: 'el campo es requerido',
                             email: 'debe ser un correo'
                    },
                    tlf_medic:{                            
                            required: 'el campo es requerido',
                            number: 'solo numeros',
                            minlength: 'minimo 6 numeros',
                            maxlength:'maximo 10 numeros',
                    },
                },
            });
});

</script>
<style type="text/css">
    
#from_user label.error {
        margin-left: 10px;
        width: auto;
        display: inline;
    }

    .error {
        text-decoration-color: red;
        color: red;
    } 
</style>