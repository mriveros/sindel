<?php 

if($_POST){  //inicio if _POST

$ci_medic = $_POST['ci_medic'];

$buscarPersona="SELECT * FROM medic_cnslt WHERE ci_medic='$ci_medic'";
$conectando = new Conection();

$verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarPersona=pg_num_rows($verificaPersona);


    if ($localizarPersona == 0){  //inicio if registrar medico

        $ATRIBUTO=pg_fetch_array($verificaPersona);
?>
        <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando Nuevo Medico</b>
          </div>
         </div> <hr>


                        
                    <form method="POST" id="registrar_medicos" action="../control/reg_medico.php" autocomplete="off">
                    <input value="<?php echo $ci_medic; ?>" name="ci_medic" id="ci_medic" class="form-control" required type="hidden" min="00000000" max="99999999" placeholder="12345678" autofocus>

                        <div class="field-box">
                            <label>Nombre Medico:</label>
                            <div class="col-md-7">
                                <input name="nom_medic" id="nom_medic" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text" autofocus>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Apellido Medico:</label>
                            <div class="col-md-7">
                                <input name="apel_medic" id="apel_medic" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text">
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
                                <input name="fn_medic" id="fn_medic" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                          Calendar.setup({
                                              inputField : "fn_medic",
                                              ifFormat   : "%d-%m-%Y",
                                              //button     : "Image1"
                                            });
                                         $("#fn_medic").keypress(function(e) {
                                           return false;
                                        });
                                        </script>
                                    

                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Direccion:</label>
                            <div class="col-md-7">
                                <input type="text" name="dir_medic" id="dir_medic" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Correo:</label>
                            <div class="col-md-7">
                                <input type="text" name="mail_medic" id="mail_medic" class="form-control" placeholder="
                                @" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Num Telefono:</label>
                            <div class="col-md-2">
                                <select name="cod_tlf" id="cod_tlf" class="form-control">
                                     <option value="0961">0961</option>
                                    <option value="0962">0962</option>
                                    <option value="0963">0963</option>
                                    <option value="0964">0964</option>
                                    <option value="0965">0965</option>
                                    <option value="0971">0971</option>
                                    <option value="0972">0972</option>
                                    <option value="0973">0973</option>
                                    <option value="0974">0974</option>
                                    <option value="0975">0975</option>
                                    <option value="0981">0981</option>
                                    <option value="0982">0982</option>
                                    <option value="0983">0983</option>
                                    <option value="0984">0984</option>
                                    <option value="0985">0985</option>
                                    <option value="0991">0991</option>
                                    <option value="0992">0992</option>
                                    <option value="0993">0993</option>
                                    <option value="0994">0994</option>
                                    <option value="0995">0995</option>
                                    <option value="021">021</option>
                                    

                                </select>
                            </div>
                            <div class="col-md-7">
                                <input type="number" name="tlf_medic" id="tlf_medic" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>
                        
                        <div class="action">
                            <input type="submit"  class="btn btn-primary" id="registrar" value="Registrar" >
                            
                        </div> 
                        
                        
                    </form>
<script>
$(document).ready(function() {
            $("select").select2();
            $("#registrar_medicos").validate({
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

<?php
}//fin if registra medico

else{ 
    
    print ("<script>alert('El medico con la cedula:$ci_medic ya esta Registrado');</script>");

     }

} //fin if _POST

?>