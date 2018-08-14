<!-- tabla de las citas del usuarios -->
<?php 
include_once('../control/conexion.php');
ini_set('display_errors', 'on');

if($_POST){
    $ci_pacnt = $_POST['ci_pacnt'];

    $buscar="SELECT * FROM cita_cnslt WHERE ci_pacnt_cita='$ci_pacnt'";
    $conectando = new Conection();

    $verifica = pg_query($conectando->conectar(), $buscar) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
    $localizar=pg_num_rows($verifica);



    if ($localizar > 0){      //inicio if 2
        $buscarPersona="SELECT * FROM pacnt_cnslt WHERE ci_pacnt='$ci_pacnt'";

        $verificaPersona = pg_query($conectando->conectar(), $buscarPersona) or die('ERROR AL BUSCAR DATOS: ' . pg_last_error());
        $localizarPersona=pg_num_rows($verificaPersona);

        if ($localizarPersona > 0){  //inicio if 3

            $ATRIBUTO=pg_fetch_array($verificaPersona);


            echo '<div class="row">
            <div class="col-md-7"> <b>Cita(s) de:</>
             '.$ATRIBUTO['nom_pacnt'].'
             '.$ATRIBUTO['apel_pacnt'].'
              </div>
             </div> <hr><br>';



             echo '<center>
             <div class="col-md-12">
             <table class="table table-striped table-bordered table-hover table-heading no-border-bottom" id="tabla_muetral" border="1" cellpadding="2">


                <tr id="esquema_tabla" class="success">


                    <th class="primary">Fecha Cita</th>
                    <th>Motivo</th>
                    <th>Acompanante</th>
                    <th>Accion</th>


                </tr>

                <tbody class=".table-striped">';

                 while($ATRIBUTO=pg_fetch_array($verifica)) {

                    echo '<tr>
                     
                        <td>'.$ATRIBUTO['fecha_cita'].'</td>
                        <td>'.$ATRIBUTO['motivo_cita'].'</td>
                        <td>'.$ATRIBUTO['acmp_cita'].'</td>

                        <td><div>&nbsp;&nbsp;&nbsp;<a class="icon-edit"href="edit_cita.php?id_cita='.$ATRIBUTO['id_cita'].'"></a>&nbsp;&nbsp;&nbsp;<a class="icon-trash" href=../control/elim_cita.php?id_cita='.$ATRIBUTO['id_cita'].'></a></div>
                        </td>

                        </tr>';

                 }';

                 </tbody>

                </table>
                </div>
                </center>';


        }//fin de if 3

    }//fin if 2


        else{
            print ("<script>alert('El paciente con la Cedula: $ci_pacnt No tiene Cita');</script>");


        }

}
?>