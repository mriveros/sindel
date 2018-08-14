<?php 

if($_POST){  //inicio if _POST

$ci_pacnt = $_POST['ci_pacnt'];

$buscarPersona="SELECT * FROM pacnt_cnslt WHERE ci_pacnt='$ci_pacnt'";
$conectando = new Conection();

$verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarPersona=pg_num_rows($verificaPersona);


    if ($localizarPersona > 0){  //inicio if modificar paciente

        $ATRIBUTO=pg_fetch_array($verificaPersona);

        echo '<div class="row">
        <div class="col-md-7"> <b>Modificando Paciente</>
          </div>
         </div> <hr>';



         echo '
                        
                    <form method="POST" action="../control/upd_paciente.php" autocomplete="off">
                    <input value="'.$ci_pacnt.'" name="ci_pacnt" id="ci_pacnt" class="form-control" required type="hidden" min="00000000" max="99999999" placeholder="12345678" autofocus>

                        <div class="field-box">
                            <label>Nombre Paciente:</label>
                            <div class="col-md-7">
                                <input name="nom_pacnt" value="'.$ATRIBUTO['nom_pacnt'].'" id="nom_pacnt" class="form-control" type="text" required type="text" autofocus>
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Apellido Paciente:</label>
                            <div class="col-md-7">
                                <input name="apel_pacnt" value="'.$ATRIBUTO['apel_pacnt'].'" id="apel_pacnt" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Fecha de Nacimiento:</label>
                            <div class="col-md-7">
                                <input name="fn_pacnt" value="'.$ATRIBUTO['fn_pacnt'].'" id="fn_pacnt" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                          Calendar.setup(
                                            {
                                          inputField : "fn_pacnt",
                                          ifFormat   : "%Y/%m/%d",
                                          //button     : "Image1"
                                            }
                                          );
                                            $("#fn_pacnt").keypress(function(e) {
                                           return false;
                                        });
                                        </script>
                                    

                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Direccion:</label>
                            <div class="col-md-7">
                                <input type="text" name="dir_pacnt" value="'.$ATRIBUTO['dir_pacnt'].'" id="dir_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Coreo:</label>
                            <div class="col-md-7">
                                <input type="text" name="mail_pacnt" value="'.$ATRIBUTO['mail_pacnt'].'" id="mail_pacnt" class="form-control" placeholder="
                                @" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Num Telefono:</label>
                            <div class="col-md-7">
                                <input type="number" name="tlf_pacnt" value="'.$ATRIBUTO['tlf_pacnt'].'" id="tlf_pacnt" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>
                        
                        <div class="action">
                            <input type="submit"  class="btn btn-primary" id="registrar" value="Registrar" >
                            
                        </div> 
                        
                        
                    </form>';


}//fin if registra paciente

else{ 
    
    print ("<script>alert('El paciente con la cedula:$ci_pacnt no se encuentra Registrado');</script>");

     }

} //fin if _POST

?>