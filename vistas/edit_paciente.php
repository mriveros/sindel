<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    } 
        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        ini_set('display_errors', 'on');  //muestra los errores de php
        $id_pacnt = $_GET['id_paciente'];
        $buscarCitas="SELECT * FROM  pacnt_cnslt WHERE id_pacnt='$id_pacnt'";
        $conectando = new Conection();
        $listaCitas = pg_query($conectando->conectar(), $buscarCitas) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        if (pg_num_rows($listaCitas) > 0) {
          
        
        $paciente = pg_fetch_array($listaCitas);
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
                    <h2 align="center">Modificar Ficha Clínica de Pacientes</h2></br></br>
                     
                    <hr>
                    <form method="POST" id="form_paciente_2" action="../control/upd_paciente.php" autocomplete="off">
                       
                            <div class="field-box">
                                <label>Cédula Paciente:</label>
                                <div class="col-md-7">
                                     <input value="<?php echo $paciente['ci_pacnt']; ?>" name="ci_pacnt" id="ci_pacnt" class="form-control" required type="text"  placeholder="12345678" autofocus>
                                </div>                            
                            </div>
                            <div class="field-box">
                                <label>Nombre Paciente:</label>
                                <div class="col-md-7">
                                    <input name="nom_pacnt" value="<?php echo $paciente['nom_pacnt']; ?>" id="nom_pacnt" class="form-control" type="text" required type="text" autofocus>
                                </div>                            
                            </div>

                            <div class="field-box">
                                <label>Apellido Paciente:</label>
                                <div class="col-md-7">
                                    <input name="apel_pacnt" value="<?php echo $paciente['apel_pacnt']; ?>" id="apel_pacnt" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text">
                                </div>                            
                            </div>
                            <div class="field-box">
                                <label>Sexo:</label>
                                <div class="col-md-4">
                                <select class="form-control" name="sexo_pacnt">
                                    
                                    <?php
                                        if ($paciente['sexo_pacnt'] == 'Masculino') {
                                            echo '
                                                <option value="Masculino" selected >Masculino</option>
                                                <option value="Femenino" >Femenino</option>
                                            ';
                                        }else{
                                             echo '
                                                <option value="Masculino"  >Masculino</option>
                                                <option value="Femenino" selected>Femenino</option>
                                            ';
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="field-box">
                                <label>Fecha de Nacimiento:</label>
                                <div class="col-md-7">
                                    <input name="fn_pacnt" value="<?php echo strftime("%d-%m-%Y",strtotime($paciente['fn_pacnt']) ); ?>" id="fn_pacnt" class="form-control" type="text" placeholder="Click Aqui" required type="text">


                                </div>                            
                            </div>

                            <div class="field-box">
                                <label>Dirección:</label>
                                <div class="col-md-7">
                                    <input type="text" name="dir_pacnt" value="<?php echo $paciente['dir_pacnt']; ?>" id="dir_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                                </div>
                            </div>

                            <div class="field-box">
                                <label>Correo:</label>
                                <div class="col-md-7">
                                    <input type="text" name="mail_pacnt" value="<?php echo $paciente['mail_pacnt']; ?>" id="mail_pacnt" class="form-control" placeholder="
                                    @" required>
                                </div>
                            </div>

                            <div class="field-box">
                                    <label>Num Teléfono:</label>
                                    <div class="col-md-2">
                                        <select name="cod_tlf_pacnt" id="cod_tlf_pacnt" class="form-control">
                                            <option value="0961" <?php if($paciente['cod_tlf_pacnt'] == "0961"){ echo "selected";} ?>>0961</option>
                                            <option value="0962" <?php if($paciente['cod_tlf_pacnt'] == "0962"){ echo "selected";} ?>>0962</option>
                                            <option value="0963" <?php if($paciente['cod_tlf_pacnt'] == "0963"){ echo "selected";} ?>>0963</option>
                                            <option value="0964" <?php if($paciente['cod_tlf_pacnt'] == "0964"){ echo "selected";} ?>>0964</option>
                                            <option value="0965" <?php if($paciente['cod_tlf_pacnt'] == "0965"){ echo "selected";} ?>>0965</option>
                                            <option value="0971" <?php if($paciente['cod_tlf_pacnt'] == "0971"){ echo "selected";} ?>>0971</option>
                                            <option value="0972" <?php if($paciente['cod_tlf_pacnt'] == "0972"){ echo "selected";} ?>>0972</option>
                                            <option value="0973" <?php if($paciente['cod_tlf_pacnt'] == "0973"){ echo "selected";} ?>>0973</option>
                                            <option value="0974" <?php if($paciente['cod_tlf_pacnt'] == "0974"){ echo "selected";} ?>>0974</option>
                                            <option value="0975" <?php if($paciente['cod_tlf_pacnt'] == "0975"){ echo "selected";} ?>>0975</option>
                                            <option value="0981" <?php if($paciente['cod_tlf_pacnt'] == "0981"){ echo "selected";} ?>>0981</option>
                                            <option value="0982" <?php if($paciente['cod_tlf_pacnt'] == "0982"){ echo "selected";} ?>>0982</option>
                                            <option value="0983" <?php if($paciente['cod_tlf_pacnt'] == "0983"){ echo "selected";} ?>>0983</option>
                                            <option value="0984" <?php if($paciente['cod_tlf_pacnt'] == "0984"){ echo "selected";} ?>>0984</option>
                                            <option value="0985" <?php if($paciente['cod_tlf_pacnt'] == "0985"){ echo "selected";} ?>>0985</option>
                                            <option value="0991" <?php if($paciente['cod_tlf_pacnt'] == "0991"){ echo "selected";} ?>>0991</option>
                                            <option value="0992" <?php if($paciente['cod_tlf_pacnt'] == "0992"){ echo "selected";} ?>>0992</option>
                                            <option value="0993" <?php if($paciente['cod_tlf_pacnt'] == "0993"){ echo "selected";} ?>>0993</option>
                                            <option value="0994" <?php if($paciente['cod_tlf_pacnt'] == "0994"){ echo "selected";} ?>>0994</option>
                                            <option value="0995" <?php if($paciente['cod_tlf_pacnt'] == "0995"){ echo "selected";} ?>>0995</option>
                                            <option value="021" <?php if($paciente['cod_tlf_pacnt'] == "021"){ echo "selected";} ?>>021</option>
                                            

                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                            <input type="number" name="tlf_pacnt" value="<?php echo $paciente['tlf_pacnt'];?>" id="tlf_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                                    </div>
                            </div>
                             <div><h4 align="center">FICHA CLINICA</h4><br></div>                    
                <fieldset>
                  <legend>Antecedentes</legend>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Personales</label>
                        <textarea name="antecedentes_personales" text="<?php echo $paciente['antecedentes_personales']; ?>" id="antecedentes_personales" class="form-control" ><?php echo $paciente['antecedentes_personales']; ?></textarea>
                    </div>
                       <div class="col-md-6">
                        <label for="">Quirúrgicos</label>
                        <textarea name="antecedentes_quirurgicos" value="<?php echo $paciente['antecedentes_quirurgicos']; ?>" id="antecedentes_quirurgicos" class="form-control" placeholder=""><?php echo $paciente['antecedentes_quirurgicos']; ?></textarea>
                    </div>
                  </div><br>
                   <div class="row">
                    <div class="col-md-6">
                        <label for="">Familiares</label>
                        <textarea name="antecedentes_familiares" value="<?php echo $paciente['antecedentes_familiares']; ?>" id="antecedentes_familiares" class="form-control" placeholder=""><?php echo $paciente['antecedentes_familiares']; ?></textarea>
                    </div>
                       <div class="col-md-6">
                        <label for="">Otros</label>
                        <textarea name="antecedentes_otros" value="<?php echo $paciente['antecedentes_otros']; ?>" id="antecedentes_otros" class="form-control" placeholder=""><?php echo $paciente['antecedentes_otros']; ?></textarea>
                    </div>
                  </div>
                </fieldset>
                  <br>
                <fieldset>
                  <legend>Hábitos Psicobiológicos</legend>
                
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Hábitos</label>
                        <textarea name="habitos" id="habitos" value="<?php echo $paciente['habitos']; ?>" class="form-control" placeholder=""><?php echo $paciente['habitos']; ?></textarea>
                    </div>
                  </div>
                </fieldset>
                <br> <br>
                            <div class="action">
                                <input type="hidden" name="id_pacnt" value="<?php echo $paciente['id_pacnt']; ?>">
                                <input type="submit"  class="btn btn-primary" id="editar" value="Editar" >
                                
                            </div> 
                        
                        
                    </form>

                </div>
            
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
            $("select").select2();
            $("#form_paciente_2").validate({
                rules: {
                    ci_pacnt : {
                            required: true,
                            number: true,
                            minlength: 5,
                            maxlength: 8,
                    },
                    nom_pacnt : {
                            required: true,
                            minlength: 2
                    },
                    apel_pacnt : {
                            required: true,
                            minlength: 2
                    },
                    sexo_pacnt : {
                            required: true,
                    },
                    fn_pacnt : {
                            required: true,
                            
                    },
                    dir_pacnt : {
                            required: true,
                    },
                    mail_pacnt : {
                            required: false,
                            email: true
                    },
                    tlf_pacnt : {
                            required: true,
                            number: true,
                            minlength: 6,
                            maxlength: 10,
                    },
                },
                messages: {
                    ci_pacnt:{                            
                            required: 'el campo es requerido',
                            number: 'solo numeros',
                            minlength: 'minimo 5 numeros',
                            maxlength:'maximo 8 numeros',
                    },
                    nom_pacnt:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    apel_pacnt:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
                    },
                    sexo_pacnt:{                            
                            required: 'el campo es requerido',
                    },
                    fn_pacnt:{                            
                            required: 'el campo es requerido',
                            
                    },
                    dir_pacnt:{                            
                            required: 'el campo es requerido',
                    },
                    mail_pacnt:{                            
                            required: 'el campo es requerido',
                             email: 'debe ser un correo'
                    },
                    tlf_pacnt:{                            
                            required: 'el campo es requerido',
                            number: 'solo numeros',
                            minlength: 'minimo 6 numeros',
                            maxlength:'maximo 10 numeros',
                    },
                },
            });

            Calendar.setup({
                            inputField : "fn_pacnt",
                            ifFormat   : "%d-%m-%Y",
                            //button     : "Image1"
            });
            $("#fn_pacnt").keypress(function(e) {
                return false;
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

<?php
        }else{
            print ("<script>alert('No hay Resgistro!.');</script>");
            print('<meta http-equiv="refresh" content="0; URL=pacientes_shows.php">');
        } 
?>