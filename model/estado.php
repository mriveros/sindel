<?php
include_once('../control/conexion.php');

class Estado {

	public Function estados(){
	
		$comparar="SELECT * FROM estados";

		$conectando = new Conection();

		$verifica = pg_query($conectando->conectar(), $comparar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
		$option='';
		while ( $estado=pg_fetch_array($verifica)) {
		 	$option.="<option value='".$estado['id_estado']."'>".$estado['estado']."</option>";
		// }
		 } ;

		 echo $option;
		
	}

}


?>