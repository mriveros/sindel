<?php  //modulo de session
    session_start();
    $usuario = $_SESSION['usuario'];
    if(!isset($usuario)){
        header("Location: ../index.php");
    }
    include_once('../control/conexion.php');
    ini_set('display_errors', 'on');  //muestra los errores de php
    
	$login_usr = $_POST['login_usr'];
    $sql="SELECT * FROM  usr_system WHERE login_usr = '$login_usr'";
	$conectando = new Conection();

	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    echo pg_num_rows($query);
    
?>









