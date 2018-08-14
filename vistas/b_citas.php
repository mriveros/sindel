<?php  
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
					<h2 align="center">Consultar Cita</h2></br></br>

                    <!---->
                     <form method="POST" action="b_citas.php">
    
                        <div class="field-box">
                            <label>Cedula:</label>
                            <div class="col-md-7">
                                <input value="<?php echo $_POST['ci_pacnt'];?>" name="ci_pacnt" id="ci_pacnt" class="form-control" required type="number" min="00000000" max="99999999" placeholder="12345678" autofocus>
                            </div>        
                                            
                       <div class="action">
                            <input type="submit"  class="btn-flat" id="buscar" value="Buscar"></input>
                        </div> 
                        
                    </form>
                    <hr>
                    <!-- tabla de las citas del usuarios -->
                                <?php include_once('t_citas.php'); ?>

                </div>
            
            </div>
        </div>
    </div>

    </div>

