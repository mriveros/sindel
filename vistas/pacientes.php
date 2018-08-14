<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){

        header("Location: ../index.php");
    } 

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
					<h2 align="center">Registrar Nueva Ficha Clínica de Pacientes</h2></br></br>

                    <!---->
                     
    
                        <div class="field-box">
                            <label>Cédula:</label>
                            <div class="col-md-7">
                                <input name="ci_pacnt" id="ci_pacnt" class="form-control" required type="number" min="00000000" max="90000000" placeholder="12345678" autofocus>
                            </div>        
                                            
                        <div class="action">
                            <input type="submit"  class="btn-flat" id="buscar_paciente" value="Buscar"></input>
                        </div> 
                        
                    
                    <hr>
                    <div id="form_paciente">
                        
                    </div>
                    
                </div>
            
            </div>
        </div>
    </div>
