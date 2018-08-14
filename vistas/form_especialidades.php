<?php // 

if($_POST){  //inicio if _POST

$esp_nom = $_POST['esp_nom'];

$buscarEspecialidad="SELECT * FROM especialidad WHERE esp_nom='$esp_nom'";
$conectando = new Conection();

$verificaEspecialidad = pg_query($conectando->conectar(), $buscarEspecialidad) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
$localizarEspecialidad=pg_num_rows($verificaEspecialidad);


    if ($localizarEspecialidad == 0){  //inicio if registrar medico

        $ATRIBUTO=pg_fetch_array($verificaEspecialidad);
?>
        <div class="row">
        <div class="col-md-7"> <b class="text-info">Registrando Nueva Especialidad</b>
          </div>
         </div> <hr>


                        
         <form method="POST" id="registrar_medicos" action="../control/reg_especialidad.php" autocomplete="off">
                    <input value="<?php echo $esp_nom; ?>" name="esp_nom" id="esp_nom" class="form-control" required type="hidden" autofocus>

                        <div class="field-box">
                            <label>Especialidad:</label>
                            <div class="col-md-7">
                                <input value="<?php echo $esp_nom; ?>" name="nom_medic" id="nom_medic" class="form-control" type="text" placeholder="Ingrese Aqui" required type="text" autofocus>
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
    
    print ("<script>alert('La especialidad ya está registrada');</script>");

     }

} //fin if _POST

?>