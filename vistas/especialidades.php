<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }


?>
<?php 


        include_once('../control/conexion.php');
        include_once('sidebar.php');
        include_once('script.php');
        ini_set('display_errors', 'on');  //muestra los errores de php

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
					<h2 align="center">Registrar Especialidad</h2></br></br>

                    <!---->
                    <form method="POST" action="especialidades.php">
    
                        <div class="field-box">
                            <label>Especialidad:</label>
                            <div class="col-md-7">
                                <input name="esp_nom" id="esp_nom" class="form-control"  >
                            </div>        
                                            
                       <div class="action">
                            <input type="submit"  class="btn-flat" id="buscar" value="Buscar"></input>
                        </div> 
                        
                    </form>
                    <hr>

                    <?php include_once('form_especialidades.php'); ?>

                </div>
            
            </div>
        </div>
    </div>
