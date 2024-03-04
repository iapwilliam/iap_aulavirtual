<?php
// echo "<pre>"; print_r($_GET); 
// exit;
	include_once('../initPdf.php');
	include_once('../config.php');
	include_once(DOC_ROOT.'/libraries.php');

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

	session_start();

	
	

	// $student->setUserId($_SESSION['User']['userId']);
	$lst = $activity->enumerateActividadCalendario($_GET['Id']);
	
	$module->setCourseModuleId($_GET["Id"]);
	$info = $module->getCourseModule();
 
	// echo '<pre>'; print_r($info);
	// exit;
	$html .= "
	<html>
	<head>
	<title>CALENDARIO DE ACTIVIDADES</title>
	<style type='text/css'>
	
	.txtTicket{
			font-size:12px;
			 font-family: sans-serif;
			text-transform: uppercase;
			/*font:bold 12px 'Trebuchet MS';*/ 
		}
		table,td {
		border: 1px solid black;
		border-collapse: collapse;
	}
	.float{

		width: 459px; !important;
		height: 200px; !important;
		
		display: inline-block
	}
	

	</style>
	</head>
	<body>
	<br>	
<img src='".DOC_ROOT."/images/logo_correo.jpg'>	
	<center>
	Calendario de actividades<br>
	".utf8_encode(utf8_decode($info['name']))."<br>
	".$infoCar['ciclo']."</center><br>
	<br>
	<br>

	";
			
	
		$html .= "
			<table width='100%' class='txtTicket'>
			<tr>
			<td>Actividad</td>
			<td>Inicio</td>
			<td>Fin</td>
			<td>Dia de Cumplimiento</td>
			<td>Puntos</td>
			</tr> ";
			foreach($lst as $key4=>$aux4){
				$html .= "
				<tr>
				<td>".$aux4['resumen']."</td> 
				<td>".$aux4['initialDate'].' '.$aux4['horaInicial']."</td> 
				<td>".$aux4['finalDate']."</td> 
				<td>".$aux4['finalDate']."</td>
				<td>".$aux4['ponderation']."</td>
				"; 
				$html .= "</tr>";
			}
			
			$html .= "</table>";

		
	
			
	
	$html .= "
		
	</body>
	</html>

	";
	// echo $html;
	// exit;
	# Instanciamos un objeto de la clase DOMPDF.
	$mipdf = new DOMPDF();
	 
	# Definimos el tamaño y orientación del papel que queremos.
	# O por defecto cogerá el que está en el fichero de configuración.
	$mipdf ->set_paper("A4", "landscape");
	 
	# Cargamos el contenido HTML.
	$mipdf ->load_html($html);
	 
	# Renderizamos el documento PDF.
	$mipdf ->render();
	 
	# Enviamos el fichero PDF al navegador.
	$mipdf ->stream('calendarioDeActividades.pdf',array('Attachment' => 0));
			


?>
