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
            <h3>Datos del Usuario <?php echo $resul['login_usr']; ?></h3> <br>
            <div class="row">
                <table class="table">
                    <tr>
                        <th>Nombre</th><td><?php echo $resul['nombre_usr']; ?></td>
                    </tr>
                    <tr>
                        <th>Apellido</th><td><?php echo $resul['apellido_usr']; ?></td>
                    </tr>
                    <tr>
                        <th>Cedula</th><td><?php echo $resul['ci_usr']; ?></td>
                    </tr>
                    <tr>
                        <th>Estado</th><td><?php
                                                if ($resul['status_usr'] == 1) {
                                                     echo 'Activo';
                                                 } else {
                                                     echo 'Inactivo';
                                                 }
                                                   ?></td>
                    </tr>
                     <tr>
                        <th>Tipo</th><td><?php
                                                if ($resul['tipo_usr'] == 1) {
                                                     echo 'Administrador';
                                                 } elseif ($resul['tipo_usr'] == 2) {
                                                     echo 'Secretaria';
                                                 }else
                                                     echo 'Profesional';
                                                   ?></td>
                    </tr>
                    
                    </thead>
                </table>
           
            </div>
        </div>
</div>

<script type="text/javascript">
    


</script>