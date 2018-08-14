<?php
	require_once('Pdf.php');

	class Reportes_pdf
	{

//-----------------------------------------------------------------------------------------------
		public function pdf( $titulo = "SISTRAERCA", $formato = 'A4' , $orientacion = 'P' , $html, $archivo = "Usuarios")
		{
					//establece el tiempo de ejecucion del script
					ini_set('max_execution_time', 'PHP_INI_ALL');
					//establece el limite de memoria para la operacion
					//ini_set('memory_limit','2000M');
			   		$pdf = new Pdf($orientacion, 'mm',$formato, true, 'UTF-8', false);
			        //$pdf->SetCreator(PDF_CREATOR);
			        $pdf->SetCreator("TecnologiaElemental c.a");
			        $pdf->SetTitle($titulo);
			       	$pdf->SetAuthor('TecnologiaElemental c.a');
					$pdf->SetSubject('TecnologiaElemental c.a');
					$pdf->SetKeywords('TecnologiaElemental c.a');
		
					// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
			        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
			        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));

					// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
			        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

					// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

					// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

					// se pueden modificar en el archivo tcpdf_config.php de libraries/config
			        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

					//relación utilizada para ajustar la conversión de los píxeles
			        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


					// ---------------------------------------------------------
					// establecer el modo de fuente por defecto
			        $pdf->setFontSubsetting(true);

					// Establecer el tipo de letra
			 
					//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
					// Helvetica para reducir el tamaño del archivo.
			        $pdf->SetFont('', '', 14, '', true);

					// Añadir una página
					// Este método tiene varias opciones, consulta la documentación para más  información.
			        $pdf->AddPage();
			        
			        

					//$pdf->SetFont('helvetica', '', 8);
					//fijar efecto de sombra en el texto
			        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

					// Establecemos el contenido para imprimir

			       
			        
			        //preparamos y maquetamos el contenido a crear
			        
					// Imprimimos el texto con writeHTMLCell()					
					$pdf->writeHTML($html, true, 0, true, 0);
					
					//$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html,$border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'center',$autopadding = true);
					// ---------------------------------------------------------
					// Cerrar el documento PDF y preparamos la salida
					// Este método tiene varias opciones, consulte la documentación para más  información.
			        $nombre_archivo = ($archivo.".pdf");
			        $pdf->lastPage();

			        $pdf->Output($nombre_archivo, 'D');
    	}
} //FIN de la clase
?>
