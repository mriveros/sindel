<?php 

require_once 'tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    public function Header() {
    /*ponemos color al texto y a las lineas */
    //colocamos la ruta de la imagen de la cabecera.

    //$direct="../img/casas.png"; 
    //$this->Image($direct,10,10,250,25,'','','N','','','C');
    /* modificamos tipografia para el subtitulo
    e insertamos este */
    $text = '<div style="text-align:center;">Lic. María Lourdes Benítez Jara <br>
        Fonoaudiologa <br>
           Consultas- Tratamientos<br>
            RIF: V-14432276-9</div>';
            //$this->writeHTMLCell(0, 1, $text, 0, false, 'C', 0, '', 0, false, 'T', 'M');
            $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $text,$border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '',$autopadding = true);
    /*trazamos una linea roja debajo del encabezado */
    $this->Line(19,25,200,25,array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));       
}
     public function Footer() {
    /* establecemos el color del texto */
    /* insertamos numero de pagina y total de paginas*/
    $text = '<div style="text-align:center;">Centro De Fonoaudiología Integral CFI. Planta Baja, consultorio , consultorio 6; Av Teniente Vera.<br> Consulta de lunes a jueves 2:00 pm/ Tlf Consultorio: (0975)122796; Cell: 0985-230520</div>';
    $this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $text,$border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '',$autopadding = true);
             
    /* dibujamos una linea roja delimitadora del pie de página */
    $this->Line(19,282,200,282,array('width' => 0.5, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0)));
}
}
/* siat-svo/reportes/Pdf.php */
