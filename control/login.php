<?php

	include_once('conexion.php');

	$usuario = $_POST['login_usr'];
	$contra = $_POST['pass_usr'];

	$sql="SELECT * FROM usr_system WHERE login_usr='$usuario' and pass_usr='$contra'";
        //conectar
    $conectando = new Conection();

    $resultado = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
    /*$resultado = pg_exec($sql);*/
	
	$cant = pg_num_rows($resultado);

	if($cant > 0){
                $resul = pg_fetch_array($resultado);
                
                session_start();
                $_SESSION['usuario']=$usuario;
                $_SESSION['tipo'] = $resul['tipo_usr'];
                $_SESSION['id'] = $resul['id_usr'];
                $_SESSION['ci'] = $resul['ci_usr'];
                $ci=$resul['ci_usr'];
                //$_SESSION['tiempo']=time();  //control de tiempo de sesion (inacvtivo)  
                $estado_user=$resul['status_usr'];
                $_SESSION['status_usr'] = $resul['status_usr'];
                //----------Obtener Especialidad----------------------
                $sql="select esp.esp_nom from medic_cnslt med, especialidad esp where med.esp_cod=esp.esp_cod
                and med.ci_medic=$ci";
                 $conectando = new Conection();
                 $resultado = pg_query($conectando->conectar(), $sql) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
                 if($cant > 0){
                 $resul = pg_fetch_array($resultado);
                 $_SESSION['especialidad'] = $resul['esp_nom'];
                 }
                 //----------------------------------------------------
                if ($estado_user == 0) {
                    session_destroy();
                    echo "<script>alert('Usted se encuentra temporalmente inactivo')</script>";
                    echo "<script>location.href = '../index.php';</script>";

                }else {
                        header("location:../vistas/principal.php");     
                }
        
        }else{
        echo "<script>alert('Los datos son incorrectos, intente nuevamente!')</script>";
        echo "<script>location.href = '../index.php';</script>";
    }
    
?>