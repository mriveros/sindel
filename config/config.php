<?php

    ini_set("default_charset", "utf-8");
    ini_set('display_errors', 'on');
    error_reporting(E_ALL ^ E_NOTICE);
    include_once('../control/conexion.php');
    $sql="SELECT * FROM  config_cita ";
    $conectando = new Conection();
    $query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $config = pg_fetch_all($query);
    foreach ($config as $value) {
    	if ($value['tipo'] == 2) {
    		 define('NUMERO_CITAS', $value['numero_cita'] );
    	} 
    	if ($value['tipo'] == 1 and $value['status'] == '1') {
    		define('PRECIO_CITA', $value['precio_cita'] );
    	}
    }

    
	