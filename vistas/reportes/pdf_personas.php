<?php 
//include_once('../../control/conexion.php');
include_once('Reportes_pdf.php');
ini_set('display_errors', 'on');
$buscar="SELECT * FROM pacnt_cnslt ";

$CONECTAR="host='127.0.0.1' dbname='consulta' user='postgres' password='123'";
$CONEXION=pg_connect($CONECTAR);

$verifica = pg_query($CONEXION, $buscar) or die('ERROR AL INSERTAR DATOS: ' . pg_last_error());
$localizar=pg_num_rows($verifica);


if ($localizar > 0){ 

 
$html= '
<h1 align="center">Datos de Investigadores</h1>

<br>

<table id="tabla_muetral" border="1" cellpadding="2">
<thead>
<tr id="esquema_tabla">

    <th><strong>CEDULA</strong></th>
    <th><strong>NOMBRE</strong></th>
    <th><strong>APELLIDOS</strong></th>
    <th><strong>TELEFONO</strong></th>
    <th><strong>SEXO</strong></th>
    
</tr>
</thead>
<tbody>';

 while($ATRIBUTO=pg_fetch_array($verifica)) {

    $html.= '<tr>
     
        <td>'.$ATRIBUTO['ci_pacnt'].'</td>
        <td>'.$ATRIBUTO['nom_pacnt'].'</td>
        <td>'.$ATRIBUTO['apel_pacnt'].'</td>
        <td>'.$ATRIBUTO['tlf_pacnt'].'</td>
        <td>'.$ATRIBUTO['sexo_pacnt'].'</td>
        

        </tr>';

 }

$html.= '   
</tbody>

</table>
';

$pdf= new Reportes_pdf();
$pdf->pdf( $titulo = "SISTRAERCA    ", $formato = 'A4' , $orientacion = 'P' , $html, $archivo = "Listado Investigadores");
}

elseif ($localizar==0) {
    print ("<script>alert('No se localizo ningun personal con la cedula especificada');</script>");
    print('<meta http-equiv="refresh" content="0; URL=../../vistas/cliente_bus.php">');
}

else {
    print ("<script>alert('Ocurrio un error al intentar localizar al personal');</script>");
    print('<meta http-equiv="refresh" content="0; URL=../../vistas/cliente_bus.php">');
}

?>
