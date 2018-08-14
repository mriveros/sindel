<?php // 

if($_POST){  //inicio if _POST

$mot_nom = $_POST['mot_nom'];

$buscarEspecialidad="SELECT * FROM motivo WHERE mot_nom='$mot_nom'";
$conectando = new Conection();

$verificaEspecialidad = pg_query($conectando->conectar(), $buscarEspecialidad) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarEspecialidad=pg_num_rows($verificaEspecialidad);


    if ($localizarEspecialidad == 0){  //inicio if registrar medico

        $ATRIBUTO=pg_fetch_array($verificaEspecialidad);
?>
        <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando nuevo Motivo</b>
          </div>
         </div> <hr>


                        
         <form method="POST" id="registrar_medicos" action="../control/reg_motivo.php" autocomplete="off">
                    <input value="<?php echo $mot_nom; ?>" name="mot_nom" id="esp_nom" class="form-control" required type="hidden" autofocus>

                        <div class="field-box">
                            <label>Motivo:</label>
                            <div class="col-md-7">
                                <input value="<?php echo $mot_nom; ?>" name="nom_medic" id="nom_medic" class="form-control" readonly="true" type="text" placeholder="Ingrese Aqui" required type="text" autofocus>
                            </div>                            
                        </div>
                        <div class="field-box">
                            <label>Descripción:</label>
                            <div class="col-md-7">
                                <input name="mot_des" id="esp_nom" class="form-control"  >
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
    
    print ("<script>alert('El motivo ya está registrado');</script>");

     }

} //fin if _POST

?>