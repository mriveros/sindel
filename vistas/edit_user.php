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
    $id_user = $_GET['id_user'];
    $sql="SELECT * FROM  usr_system WHERE id_usr = '$id_user'";
	$conectando = new Conection();

	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $resul = pg_fetch_array($query);
?>
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Editar Usuario <?php echo $resul['login_usr']; ?></h3> <br>


       <form method="POST" class="form-horizontal" action="../control/update_user.php" autocomplete="off">
                       
                        <div class="form-group">
                                <label class="control-label col-xs-2">Nombre:</label>
                                <div class="col-md-7">
                                         <input name="nombre_usr" id="nombre_usr" class="form-control" required type="text" placeholder="Jose" value="<?php echo $resul['nombre_usr']; ?>" autofocus>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-2">Apellido:</label>
                                <div class="col-md-7">
                                         <input name="apellido_usr" id="apellido_usr" class="form-control" required type="text" placeholder="Perales" value="<?php echo $resul['apellido_usr']; ?>">
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-2">Cedula:</label>
                                <div class="col-md-7">
                                         <input name="ci_usr" id="ci_usr" class="form-control" required type="numeric" min="00000000" max="99999999" placeholder="12345678" value="<?php echo $resul['ci_usr']; ?>" >
                                </div>
                        </div>

                        <div class="form-group">
                            
                            <label class="control-label col-xs-2">Tipo de Usuario:</label>
                            <div class="col-md-7">
                               <label class="select">
                               <select  name="tipo_usr" class="form-control" id="tipo_usr" required>
                                       <?php 
                                        	if ($resul['tipo_usr'] == 1) {
                                        ?>
                                        		<option value="">Seleccione</option>
		                                        <option value="1" selected>Administrador</option>
		                                        <option value="2">Secretaria</option>
                                                        <option value="3">Profesional</option>
		                                <?php
                                        	} else if ($resul['tipo_usr'] == 2) {
                                        ?>
                                        		<option value="">Seleccione</option>
		                                        <option value="1">Administrador</option>
		                                        <option value="2" selected>Secretaria</option>
                                                        <option value="3">Profesional</option>
                                        
                                        <?php
                                                } else if ($resul['tipo_usr'] == 3) {
                                        ?>
                                        		<option value="">Seleccione</option>
		                                        <option value="1">Administrador</option>
		                                        <option value="2" >Secretaria</option>
                                                        <option value="3"selected>Profesional</option>
                                        <?php } ?>
                                                        
                
                               </select>
                               </label>
                            </div>                                                  
                        </div>

                         <div class="form-group">
                            
                            <label class="control-label col-xs-2">Estado:</label>
                            <div class="col-md-7">
                               <label class="select">
                               <select  name="status_usr" class="form-control" id="status_usr" required>
                                        <?php 
                                        	if ($resul['status_usr'] == 0) {
                                        ?>
                                        		<option value="">Seleccine</option>
		                                        <option value="1">Activo</option>
		                                        <option value="0" selected>Inactivo</option> 

		                                <?php
                                        	} else {
                                        ?>
                                        		<option value="">Seleccine</option>
		                                        <option value="1" selected>Activo</option>
		                                        <option value="0">Inactivo</option>
                                        <?php
                                        	}
                                        ?>                                                                        
                               </select>
                               </label>
                            </div>                                                  
                        </div>

                        <div class="action">
                        	<input type="hidden" value="<?php echo $resul['id_usr']; ?>" name="id_usr"></input>
                            <input type="submit"  class="btn-flat" id="registrar" value="Editar" >
                            
                        </div> 
                        
                        
                    </form>
        
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $("#registrar").click(function(event) {
         if ( $("#re_pass_usr").val() == $("#pass_usr").val() ) {

         }else{
            event.preventDefault();
            alert("Las contraseñas no son iguales!");
            $("#re_pass_usr").val('');
            $("#pass_usr").val('');
            $("#pass_usr").focus();
         }
         
    });
 

    $("#").click(function() {
        var login_usr = $("#login_usr").val();
    
        $.ajax({
                url: "buscar_login.php",
                type : 'POST',
                data: { 
                        login_usr : login_usr
                      },
                success:
                        function (data) {
                                                        
                        }
        });
    });




});


</script>