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
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Nuevo Usuario</h3> <br>


       <form method="POST" id="from_user" class="form-horizontal" action="../control/reg_user.php" autocomplete="off">
                     
                        <div class="form-group">
                                <label class="control-label col-xs-2">Nombre:</label>
                                <div class="col-md-7">
                                         <input name="nombre_usr" id="nombre_usr" class="form-control" required type="text" placeholder="Jose" autofocus>
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-2">Apellido:</label>
                                <div class="col-md-7">
                                         <input name="apellido_usr" id="apellido_usr" class="form-control" required type="text" placeholder="Perales" >
                                </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-2">Cédula:</label>
                                <div class="col-md-7">
                                         <input tittle="El numero de Cédula debe Coincidir con el Profesional para poder iniciar Sesión" name="ci_usr" id="ci_usr" class="form-control" required type="numeric"  placeholder="12345678" >
                                </div>
                        </div>

                        

                       <div class="form-group">
                            
                            <label class="control-label col-xs-2">Nombre de Usuario:</label>
                            <div class="col-md-7">
                                <input name="login_usr" id="login_usr" class="form-control" type="text" placeholder="user1" required type="text">
                            </div>
                            <div id="msg" class="col-md-3">
                                
                            </div>                           
                        </div>

                        <div class="form-group">
                            
                            <label class="control-label col-xs-2">Tipo de Usuario:</label>
                            <div class="col-md-7">
                               <label class="select">
                               <select  name="tipo_usr" class="form-control" id="tipo_usr" required>
                                        <option value="">Seleccine</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Secretaria</option>  
                                        <option value="3">Profesional</option> 
                               </select>
                               </label>
                            </div>                                                  
                        </div>


                        <div class="form-group">
                            <label class="control-label col-xs-2">Contraseña:</label>
                            <div class="col-md-7">
                                <input type="password" name="pass_usr" id="pass_usr" class="form-control is0" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-2">Repetir Contraseña:</label>
                            <div class="col-md-7">
                                <input type="password" name="re_pass_usr" id="re_pass_usr" class="form-control" placeholder="Ingrese Aqui" required>
                            </div>
                        </div>
                        
                        <div class="action">
                            <input type="submit"  class="btn-flat" id="registrar" disabled value="Registrar" >
                            
                        </div> 
                        
                      
                    </form>
        
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $("#login_usr").keyup(function() {
        var login_usr = $("#login_usr").val();

        $.ajax({
                url: "buscar_login.php",
                type : 'POST',
                data: { 
                        login_usr : login_usr
                      },
                success:
                        function (data) {
                            if (data > 0) {
                                 $("#registrar").attr('disabled','disabled');
                                 $("#msg").html('<spam class="text-danger">el nombre de usuario no esta disponible intente con otro</spam>');
                            } else {
                                
                                if (login_usr == '') {
                                            $("#registrar").attr('disabled','disabled');
                                            $("#msg").html('');
                                }else{
                                            $("#msg").html('<spam class="text-success">el nombre de usuario esta disponible</spam>');
                                            $("#registrar").removeAttr('disabled');
                                            $("#registrar").removeClass( "btn-flat" ).addClass( "btn btn-primary" );
                                }
                                

                           }                            
                        }
        });
    });

$("#from_user").validate({
  rules: {
    nombre_usr: 
                {
                    required: true,
                    minlength: 2
                },
    apellido_usr: 
                {
                    required: true,
                    minlength: 2
                },
    ci_usr:     {
                    number : true,
                    required: true,
                    minlength: 6,                    
    },
    tipo_usr:   {
                     required: true,
    },
    pass_usr:   {
                    required: true,
                    minlength: 6,
    },
    re_pass_usr: {
                    equalTo: "#pass_usr",
                    required: true,
    },
     login_usr: {
                  required: true,
    }
  },
  messages: {
    nombre_usr: 
                {
                    required: 'el campo es requerido',
                    minlength: 'minimo 2 caracteres'
                },
    apellido_usr: 
                {
                    required: 'el campo es requerido',
                    minlength: 'minimo 2 caracteres'
                },
    ci_usr:     {
                    number : 'solo numeros',
                    required: 'el campo es requerido',
                    minlength: 'minimo 6 caracteres',                
    },
    tipo_usr:   {
                     required: 'el campo es requerido',
    }, 
    pass_usr:   {
                    required: 'el campo es requerido',
                    minlength: 'minimo 6 caracteres',
    },
    re_pass_usr: {
                    equalTo: "La contaseña no es igual",
                    required: 'el campo es requerido',
    },
    login_usr: {
                  required: 'el campo es requerido',
    },
    
  }
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