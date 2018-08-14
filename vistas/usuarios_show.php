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
    $sql="SELECT * FROM  usr_system ";
	$conectando = new Conection();
    $i =1;
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
?>
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Listas de Usuarios</h3> <br>
        <div class="row">
            <div class="col col-md-6">
                <a href="user_create.php" class="btn btn-primary">
                	<i class="icon-plus-sign" ></i> Agregar Usuario
                </a>
                
            </div>                                                    
        </div><br>
        <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>estado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody id="tbody">

<?php	if( pg_num_rows($query) > 0 ){

        $resul = pg_fetch_all($query);
            foreach ( $resul as $value) {
?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['login_usr']; ?></td>
                    <td><?php if ($value['status_usr'] == 1 ){
                    					echo "Activo";
                    		  }else{
                    		  			echo "Inactivo";
                    		  }
                    	 ?>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="show_usuario.php?id_user=<?php echo $value['id_usr']; ?>" class="btn btn-info" title="Ver"><i class="icon-eye-open"></i></a>
                            <a href="edit_user.php?id_user=<?php echo $value['id_usr']; ?>" class="btn btn-primary" title="Editar"><i class="icon-pencil"></i></a>
                            <!-- <a href="#" class="btn btn-danger" title="Generar Reporte"><i class="fa fa-file-pdf-o"></i></a> -->
                        </div>
                    </td>
                </tr>   
<?php   
            }
    }else{ ?>
        <tr>    
            <td colspan="4">No hay Registros</td>
        </tr>
<?php    }
	


?> 
        </tbody>
        </table>
</div>
</div>

<script type="text/javascript">
    


</script>