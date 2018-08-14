<?php // 

if($_POST){  //inicio if _POST

$tra_nom = $_POST['tra_nom'];

$buscarTratamiento="SELECT * FROM tratamiento_dental WHERE tra_nom='$tra_nom'";
$conectando = new Conection();

$verificaTratamiento = pg_query($conectando->conectar(), $buscarTratamiento) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarTratamiento=pg_num_rows($verificaTratamiento);


    if ($localizarTratamiento == 0){  //inicio if registrar medico

        $ATRIBUTO=pg_fetch_array($verificaTratamiento);
?>
        <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando nuevo Tratamiento</b>
          </div>
         </div> <hr>


                        
         <form method="POST" id="registrar_medicos" action="../control/reg_tratamiento.php" autocomplete="off">
                    <input value="<?php echo $tra_nom; ?>" name="tra_nom" id="esp_nom" class="form-control" required type="hidden" autofocus>

                        <div class="field-box">
                            <label>Tratamiento:</label>
                            <div class="col-md-7">
                                <input value="<?php echo $tra_nom; ?>" name="tra_nom" id="nom_medic" class="form-control" readonly="true" type="text" placeholder="Ingrese Aqui" required type="text" autofocus>
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Costo:</label>
                            <div class="col-md-7">
                                <input type="number" name="tra_costo" id="tra_costo" class="form-control"  >
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
    
    print ("<script>alert('El Tratamiento ya está registrado');</script>");

     }

} //fin if _POST

?>