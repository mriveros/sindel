<?php 
    //verificar si mi session existe, si existe lo pasa a prinpipal hasta q la session se destruya
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: vistas/principal.php");
    }
?>
<!DOCTYPE html>
<html class="login-bg" lang="es">
<head>
    <title> - Iniciar Sesión - </title>
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!-- bootstrap -->
    <link href="vistas/css/bootstrap/bootstrap.css" rel="stylesheet" />    
    <link href="vistas/css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="vistas/css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="vistas/css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="vistas/css/compiled/icons.css" />

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="vistas/css/lib/font-awesome.css" />
    
    <!-- this page specific styles -->
    <link rel="stylesheet" href="vistas/css/compiled/signup.css" type="text/css" media="screen" />
</head>

<body>
    <div class="header">
        
    </div>
    <div class="login-wrapper">
        <form id="miFormulario" action="control/login.php" method="POST" autocomplete="off">
        
            <div class="box">
                <div class="content-wrap">
                    <h6>Iniciar Sesión</h6>
                    <input name="login_usr" id="login_usr" class="form-control" type="text" placeholder="Usuario" required autofocus>
                    <input name="pass_usr" id="pass_usr" class="form-control" type="password" placeholder="Contraseña" required>                
                    <div class="action">
                        <button class="btn-flat" id="submit">Iniciar Sesión</button>
                    </div>                
                </div>
                <div id="msg">                            
                </div>
            </div>
        </form>
    </div>
	<script src="vistas/js/jquery-1.10.2.js"></script> 
    <script src="vistas/js/bootstrap.min.js"></script>
    <script src="vistas/js/theme.js"></script>
</body>
</html>
