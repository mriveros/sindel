<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    } 
        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        $tra_cod = $_GET['tra_cod'];
        ini_set('display_errors', 'on');  //muestra los errores de php
        $sql="SELECT * FROM  tratamiento_dental WHERE tra_cod='$tra_cod'";
        $conectando = new Conection();
        $query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $tratamiento = pg_fetch_array($query);
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
                    <h2 align="center">Modificar Tratamiento</h2></br></br>

                    <!---->
                      <form method="POST" id="editrar_medicos" action="../control/upd_tratamiento.php" autocomplete="off">
                    

                        <div class="field-box">
                            <label>Tratamiento:</label>
                            <div class="col-md-7">
                                <input name="tra_nom" value="<?php echo $tratamiento['tra_nom']; ?>" id="esp_nom" class="form-control" type="text" required type="text" autofocus>
                            </div>                            
                        </div>
                          <div class="field-box">
                            <label>Costo:</label>
                            <div class="col-md-7">
                                <input name="tra_costo" value="<?php echo $tratamiento['tra_costo']; ?>" id="esp_nom" class="form-control" type="text" required type="text">
                            </div>                            
                        </div>

                        <div class="field-box">
                            <label>Estado</label>
                                <div class="col-md-7">
                                    <div class="radio">
                                    <label><input type="radio" name="tra_activo" value="1" checked /> Activo</label>
                                    <label><input type="radio" name="tra_activo" value="0" /> Inactivo</label>
                                    </div>
                                </div>
                            </div>	
                        <div class="action">
                            <input type="hidden" name="tra_cod" value="<?php echo $tra_cod; ?>">
                            <input type="submit"  class="btn btn-primary" id="editar" value="Editar" >
                            <a href="index_tratamientos.php" class="btn btn-default">Cancelar</a>
                            
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