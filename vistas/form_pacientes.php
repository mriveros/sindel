<?php 
include_once('../control/conexion.php');
ini_set('display_errors', 'on');  //muestra los errores de php
$ci_pacnt = $_POST['cedula_paciente'];

$buscarPersona="SELECT * FROM pacnt_cnslt WHERE ci_pacnt='$ci_pacnt'";
$conectando = new Conection();

$verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarPersona=pg_num_rows($verificaPersona);


    if ($localizarPersona == 0){  //inicio if registrar paciente

        $ATRIBUTO=pg_fetch_array($verificaPersona);
?>
       <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando Nueva Ficha de Paciente</b></div>
         </div> <hr>



        
                        
                    <form method="POST" action="../control/reg_paciente.php" id="form_paciente_2" autocomplete="off">
                    <input value="<?php echo $ci_pacnt; ?>" name="ci_pacnt" id="ci_pacnt" class="form-control" required type="hidden" min="00000000" max="99999999" placeholder="12345678" autofocus>

                        <div class="field-box">
                            <label>Nombres Paciente:</label>
                            <div class="col-md-7">
                                <input  name="nom_pacnt" id="nom_pacnt" class="form-control" type="text" placeholder="Ingrese Aqui" required  autofocus>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Apellidos Paciente:</label>
                            <div class="col-md-7">
                                <input title="Apellido del Paciente" name="apel_pacnt" id="apel_pacnt" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text">
                            </div>                            
                        </div>
                        
                        <div class="field-box">
                            <label>Sexo:</label>
                            <div class="col-md-4">
                            <select class="form-control" name="sexo_pacnt" id="sexo_pacnt">
                                <option value="Masculino" >Masculino</option>
                                <option value="Femenino" >Femenino</option>
                            </select>
                            </div>
                        </div>


                        <div class="field-box">
                            <label>Fecha de Nacimiento:</label>
                            <div class="col-md-4">
                                <input title="Fecha del Paciente" name="fn_pacnt" id="fn_pacnt" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                        
                                        </script>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Dirección:</label>
                            <div class="col-md-7">
                                <input title="Direccion del Paciente" type="text" name="dir_pacnt" id="dir_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Correo:</label>
                            <div class="col-md-7">
                                <input title="Correo del Paciente" type="text" name="mail_pacnt" id="mail_pacnt" class="form-control" placeholder="  @" required>
                            </div>
                        </div>

                        
                        <div class="field-box">
                            <label>Num Teléfono:</label>
                            <div class="col-md-2">
                                <select name="cod_tlf_pacnt" id="cod_tlf_pacnt" class="form-control">
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
                                                
                            <div class="col-md-5">
                            
                                <input type="number" name="tlf_pacnt" id="tlf_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                            
                            </div>
                        </div>    
                 <div><h4 align="center">FICHA CLINICA</h4><br></div>                    
                <fieldset>
                  <legend>Antecedentes</legend>
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Personales</label>
                        <textarea name="antecedentes_personales" id="antecedentes_personales" class="form-control" ></textarea>
                    </div>
                       <div class="col-md-6">
                        <label for="">Quirúrgicos</label>
                        <textarea name="antecedentes_quirurgicos" id="antecedentes_quirurgicos" class="form-control" placeholder=""></textarea>
                    </div>
                  </div><br>
                   <div class="row">
                    <div class="col-md-6">
                        <label for="">Familiares</label>
                        <textarea name="antecedentes_familiares" id="antecedentes_familiares" class="form-control" placeholder=""></textarea>
                    </div>
                       <div class="col-md-6">
                        <label for="">Otros</label>
                        <textarea name="antecedentes_otros" id="antecedentes_otros" class="form-control" placeholder=""></textarea>
                    </div>
                  </div>
                </fieldset>
                  <br>
                <fieldset>
                  <legend>Hábitos Psicobiológicos</legend>
                
                  <div class="row">
                    <div class="col-md-6">
                        <label for="">Hábitos</label>
                        <textarea name="habitos" id="habitos" class="form-control" placeholder=""></textarea>
                    </div>
                  </div>
                </fieldset>
                <br> <br>             
                        <div class="action">
                            <input type="submit"  class="btn btn-primary" id="registrar" value="Registrar" >
                            
                        </div> 
                        
                        
                    </form>
<script>
$(document).ready(function() {
            $("select").select2();
            $("#form_paciente_2").validate({
                rules: {
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
}//fin if registra paciente

else{ 
    
    print ("<script>alert('El paciente con la cedula:$ci_pacnt ya esta Registrado');</script>");

     }



?>