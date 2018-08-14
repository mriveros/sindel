<?php 

if($_POST){
$ci_pacnt = $_POST['ci_pacnt'];

$buscar="SELECT * FROM cita_cnslt WHERE ci_pacnt_cita='$ci_pacnt'";
$conectando = new Conection();

$verifica = pg_query($conectando->conectar(), $buscar) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizar=pg_num_rows($verifica);

//REgistrando otra cita al paciente 1:m
if ($localizar > 0){        //inicio if otra cita
    print ("<script>alert('Ya tiene una cita Asignada ');</script>");

    $buscarPersona="SELECT * FROM pacnt_cnslt WHERE ci_pacnt='$ci_pacnt'";

    $verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $localizarPersona=pg_num_rows($verificaPersona);

    if ($localizarPersona > 0){  //inicio if registrar otra cita

        $ATRIBUTO=pg_fetch_array($verificaPersona);


        echo '<div class="row">
        <div class="col-md-7"> <b class="text-info">Agregando Cita a:</b>
         '.$ATRIBUTO['nom_pacnt'].'
         '.$ATRIBUTO['apel_pacnt'].'
          </div>
         </div> <hr>';


         echo '
                        
                    <form method="POST" action="../control/reg_cita.php" autocomplete="off">
                    <input value="'.$ci_pacnt.'" name="ci_pacnt_cita" id="ci_pacnt_cita" class="form-control" required type="hidden" min="00000000" max="99999999" placeholder="12345678" autofocus>

                        <div class="field-box">
                            <label>Fecha de Cita:</label>
                            <div class="col-md-7">
                                <input name="fecha_cita" id="fecha_cita" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                          Calendar.setup(
                                            {
                                          inputField : "fecha_cita",
                                          ifFormat   : "%Y/%m/%d",
                                          //button     : "Image1"
                                            }
                                          );
                                          $("#fecha_cita").keypress(function(e) {
                                                    return false;
                                                });
                                        </script>
                                    

                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Motivo Cita:</label>
                            <div class="col-md-7">
                                <input type="text" name="motivo_cita" id="motivo_cita" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Acompanante:</label>
                            <div class="col-md-7">
                                <input type="text" name="acmp_cita" id="acmp_cita" class="form-control" placeholder="Ingrese Aqui">
                            </div>
                        </div>
                        
                        <div class="action">
                            <input type="submit"  class="btn-flat" id="registrar" value="Registrar" >
                            
                        </div> 
                        
                        
                    </form>';
}//inicio if registrar otra c

}//fin if otra cita

else{  //registrar cita a paciente

    $buscarPersona="SELECT * FROM pacnt_cnslt WHERE ci_pacnt='$ci_pacnt'";

    $verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $localizarPersona=pg_num_rows($verificaPersona);

    if ($localizarPersona > 0){

        $ATRIBUTO=pg_fetch_array($verificaPersona);


        echo '<div class="row">
        <div class="col-md-7"> <b class="text-info">Agregando cita a:</b>
         '.$ATRIBUTO['nom_pacnt'].'
         '.$ATRIBUTO['apel_pacnt'].'
          </div>
         </div> <hr>';


         echo '
                        
                    <form method="POST" action="../control/reg_cita.php" autocomplete="off">
                    <input value="'.$ci_pacnt.'" name="ci_pacnt_cita" id="ci_pacnt_cita" class="form-control" required type="hidden" min="00000000" max="99999999" placeholder="12345678" autofocus>

                        <div class="field-box">
                            <label>Fecha de Cita:</label>
                            <div class="col-md-7">
                                <input name="fecha_cita" id="fecha_cita" class="form-control" type="text" placeholder="Click Aqui" required type="text">

                                        <script type="text/javascript">
                                          Calendar.setup(
                                            {
                                          inputField : "fecha_cita",
                                          ifFormat   : "%Y/%m/%d",
                                          //button     : "Image1"
                                            }
                                          );
                                        </script>
                                    

                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Motivo Cita:</label>
                            <div class="col-md-7">
                                <input type="text" name="motivo_cita" id="motivo_cita" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="field-box">
                            <label>Acompanante:</label>
                            <div class="col-md-7">
                                <input type="text" name="acmp_cita" id="acmp_cita" class="form-control" placeholder="Ingrese Aqui">
                            </div>
                        </div>

                        
                        <div class="action">
                            <input type="submit"  class="btn-flat" id="registrar" value="Registrar" >
                            
                        </div> 
                        
                        
                    </form>';
}

else{
    print ("<script>alert('El paciente con la Cedula: $ci_pacnt No esta Registrado');</script>");

}
}
}
?>