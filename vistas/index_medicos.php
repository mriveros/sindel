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
    $sql="SELECT * FROM  medic_cnslt med, especialidad esp where med.esp_cod=esp.esp_cod";
	$conectando = new Conection();
    $i = 1;
	$query = pg_query($conectando->conectar(), $sql) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
?>
  <div class="content">
        <div id="pad-wrapper" class="form-page"> 
        <h3>Listas de Medicos</h3><br>
        <div class="row">
            <div class="col col-md-6">
                <a href="medicos.php" class="btn btn-primary">
                    <i class="icon-plus-sign" ></i>  Registrar Medico
                </a>
                
            </div>                                                    
        </div><br><br>
        <div class="row">
         <table class="table table-condensed table-striped table-hover dataTable" id="table_citas">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>               
                <th>Especialidad</th>
                <th>Email</th>
                <th>Estado</th>
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
                    <td><?php echo $value['nom_medic']; ?> <?php echo $value['apel_medic']; ?></td>
                   
                    <td><?php echo $value['esp_nom']; ?></td>
                    <td><?php echo $value['mail_medic']; ?></td>
                    <td><?php if ($value['med_activo']=='t'){echo "Activo";}else echo"Inactivo";; ?></td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="show_medico.php?id_medic=<?php echo $value['id_medic'];?>" class="btn btn-info" title="Ver"><i class="icon-eye-open"></i></a>
                            <a href="edit_medico.php?id_medic=<?php echo $value['id_medic'];?>" class="btn btn-primary" title="Modificar"><i class="icon-pencil"></i></a>
                            <a   class="btn btn-danger" title="Eliminar" onclick="delete_medico(<?php echo $value['id_medic'];?>);"><i class="icon-trash"></i></a>
                        </div>
                    </td>
                </tr>   
<?php   
            }
    }else{ ?>
        
<?php    }
	


?> 
        </tbody>
        </table>
</div>
</div>

<script type="text/javascript">
    //href="../control/delete_medico.php?id_medic=<?php //echo $value['id_medic'];?>".



    function delete_medico(cod_med){
        swal({
          title: "Está seguro que desea cambiar el estado del Médico?",
          text: "El estado del Médico estará inactivo y no podrá seleccionarse en las consultas",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
                $.ajax({
                    url: "../control/delete_medico.php",
                    type : 'GET',
                    data: { id_medic : cod_med },
                    dataType: 'script'
                    });
            swal("Operación realizada exitosamente", {
                    icon: "success",
            });
            window.location.href = 'index_medicos.php';
            }else {
                swal("Operación cancelada");
            }
           
        });
    }

    $(document).ready(function() {
        
    });
 


</script>