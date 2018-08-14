<?php // 

if($_POST){  //inicio if _POST

$enf_nom = $_POST['enf_nom'];

$buscarEnfermedad="SELECT * FROM enfermedad WHERE enf_nom='$enf_nom'";
$conectando = new Conection();

$verificaEnfermedad = pg_query($conectando->conectar(), $buscarEnfermedad) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarEnfermedad=pg_num_rows($verificaEnfermedad);


    if ($localizarEnfermedad == 0){  //inicio if registrar medico

        $ATRIBUTO=pg_fetch_array($verificaEnfermedad);
?>
        <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando Nueva Enfermedad</b>
          </div>
         </div> <hr>


                        
         <form method="POST" id="registrar_medicos" action="../control/reg_enfermedad.php" autocomplete="off">
                    <input value="<?php echo $enf_nom; ?>" name="esp_nom" id="esp_nom" class="form-control" required type="hidden" autofocus>

                        <div class="field-box">
                            <label>Enfermedad:</label>
                            <div class="col-md-7">
                                <input value="<?php echo $enf_nom; ?>" name="enf_nom" id="enf_nom" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text" autofocus required>
                            </div>                            
                        </div>
                    
                        <div class="field-box">
                            <label>Descripción:</label>
                            <div class="col-md-7">
                                <input type="text" name="enf_des" id="enf_des" class="form-control" placeholder="Ingrese Aqui">
                            </div>
                        </div>
                        <div class="field-box">
                            <label>Síntomas:</label>
                            <div class="col-md-7">
                                <textarea type="text" name="enf_sintomas" id="enf_sintomas" class="form-control" placeholder="Ingrese Aqui" rows="7"></textarea>
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
                    
                },
                messages: {
                    nom_medic:{                            
                            required: 'el campo es requerido',
                            minlength: 'minimo 2 caracteres'
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
    
    print ("<script>alert('La Enfermedad ya está registrada');</script>");

     }

} //fin if _POST

?>