<?php
include_once('../initPdf.php');
include_once('../config.php');
include_once(DOC_ROOT.'/libraries.php');

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;

session_start();
$util = new Util;
$module->setCourseModuleId($_GET["Id"]);
$info = $module->getCourseModule();	
// echo "<pre>";
// var_dump($info);
// exit;

$isEnglish = false;
if($info['materia'] == 0)
	$isEnglish = true;
	
if($info['modality'] == 'Online')
{
	$rov = $info['rvoeLinea'];
	$fecharov = $info['fechaRvoeLinea']; 
}
else
{
	
	$rov = $info['rvoe'];
	$fecharov = $info['fechaRvoe'];
}
	
$course->setCourseId($info["courseId"]);
$infoCo = $course->getCourse();	
/* echo "<pre>";
print_r($infoCo);
exit; */
$group->setCourseModuleId($_GET["Id"]);
$group->setCourseId($info["courseId"]);
$group->setTipoMajor($info["majorName"]);
$noTeam = $group->actaCalificacion();
$studentsRepeat = $group->actaCalificacionRepeat();
$infoFirma = $personal->extraeFirmaActa(); 
$infoPersonal = $personal->getPersonal("OR personalId = ".$info['access'][1]);
	
	$html .= "
	<html>
	<head>
	<title>Acta de Calificaciones</title>
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
	.notas{
			font-size:10px;
			 font-family: sans-serif;
			text-transform: uppercase;
			/*font:bold 12px 'Trebuchet MS';*/ 
		}
		table,td {
		border: 1px solid black;
		 border-collapse: collapse;
	}
	.wrapper-page {
		page-break-after: always;
	}
	
	.wrapper-page:last-child {
		page-break-after: avoid;
	}
	</head>
	<body>
		<div class='wrapper-page'>
			<img src='" . DOC_ROOT . "/images/logo_correo.jpg'>
			<center>	
			<b>INSTITUTO DE ADMINISTRACIÓN PÚBLICA DEL ESTADO DE CHIAPAS, A.C.</b>
			<br>
			<b>" . $info['majorName'] . ": " . $info['subjectName'] . "</b><br>
			<b>ACTA DE CALIFICACIÓN FINAL</b><br>
			</center>	
			<br>
			
			<table class='txtTicket' width='100%'>
			<tr>
				<td>Acuerdo: No.: </td>
				<td>" . $rov . " de fecha " . $fecharov . "</td>
			</tr>
			<tr>
				<td>Ciclo: </td>
				<td>" . $infoCo["scholarCicle"] . "</td>
			</tr>
			<tr>
				<td>Materia:</td>
				<td>" . $info['claveMateria'] . " " . $info['name'] . "</td>
			</tr>	
			<tr>
				<td>" . mb_strtoupper($infoCo['tipoCuatri']) . ":</td>
				<td>" . $info['semesId'] . "</td>
			</tr>
			<tr>
				<td>Grupo:</td>
				<td>" . $info['groupA'] . "</td>
			</tr>
			<tr>
				<td>Periodo:</td>
				<td>" . $info['initialDate'] . " - " . $info['finalDate'] . "</td>
			</tr>
			
			</table>
			<br>

			";

			$html .= "<table  width='100%' class='txtTicket'>";
			$html .= "<tr>";
			$html .= "<td style='width:11px'><center>Num.</center></td>";
			$html .= "<td ><center>Nombre</center></td>";
			$html .= "<td style='width:100px'><center>Calificación Final</center></td>";
			$html .= "<td style='width:100px'><center>Letra</center></td>";
			$html .= "</tr>";
			foreach($noTeam as $key=>$aux){
				$html .= "<tr>";
				$html .= "<td>".($key+1)."</td>";
				$html .= "<td>".$aux['lastNamePaterno']." ".$aux['lastNameMaterno']." ".$aux['names']."</td>";
				$h =  $util->num2letras($aux['score']);
				
				if($aux['score'] == 0) 
				{
					$html .= "<td><center><font color='red'>NP</font></center></td>";
					$html .= "<td><center><font color='red'>NO PRESENTÓ</font></center></td>";
				}
				else if($aux['score'] < 7  and $info['majorName'] == 'MAESTRÍA')
				{
					if($isEnglish)
					{
						$html .= "<td><center><font color='red'>NA</font></center></td>";
						$html .= "<td><center><font color='red'>No Aprobado</font></center></td>";
					}
					else
					{
						$html .= "<td><center><font color='red'>" . 6 . "</font></center></td>";
						$html .= "<td><center><font color='red'>SEIS</font></center></td>";
					}
				}
				else if($aux['score'] < 8  and $info['majorName'] == 'DOCTORADO')
				{
					if($isEnglish)
					{
						$html .= "<td><center><font color='red'>NA</font></center></td>";
						$html .= "<td><center><font color='red'>No Aprobado</font></center></td>";
					}
					else
					{
						$html .= "<td><center><font color='red'>" . 7 . "</font></center></td>";
						$html .= "<td><center><font color='red'>SIETE</font></center></td>";
					}
				}
				else{
					if($isEnglish)
					{
						$html .= "<td><center>A</center></td>";
						$html .= "<td><center>Aprobado</center></td>";
					}
					else
					{
						$html .= "<td><center>" . $aux['score'] . "</center></td>";
						$html .= "<td><center>" . $h . "</center></td>";
					}
				}
				$html .= "</tr>";
			}  
			$html .= "</table>";
			
			$html .= "
				
			<br>
			<br>
			<br>
			<center>
				
			
			<table width=100% align='center' style='border: none' class='txtTicket'>	
				<tr>
					<td colspan='2' align='center' style='border: none'>
					".$infoPersonal['profesion']." ".$infoPersonal['name']." ".$infoPersonal['lastname_paterno']." ".$infoPersonal['lastname_materno']."<br>
					Catedrático (a)
					
					<br>
					<br>
					<br>
					</td>
				</tr>
				<tr>
					<td align='center' style='border: none'>
						".$infoFirma['director']."<br>
						Directora Academica
					</td>
					<td align='center' style='border: none'> 
						".$infoFirma['controlEscolar']."<br>
						Servicios Escolares
					</td>
				</tr>
			</table>	
				
			</center>
		</div>

		<div class='wrapper-page'>
			<img src='".DOC_ROOT."/images/logo_correo.jpg'>
			<center>	
			<b>INSTITUTO DE ADMINISTRACIÓN PÚBLICA DEL ESTADO DE CHIAPAS, A.C.</b>
			<br>
			<b>".$info['majorName'].": ".$info['subjectName']."</b><br>
			<b>ACTA DE CALIFICACIÓN FINAL</b><br>
			</center>	
			<br>
			
			<table class='txtTicket' width='100%'>
			<tr>
				<td>Acuerdo: No.: </td>
				<td>".$rov." de fecha ".$fecharov."</td>
			</tr>
			<tr>
				<td>Ciclo: </td>
				<td>".$infoCo["scholarCicle"]."</td>
			</tr>
			<tr>
				<td>Materia:</td>
				<td>".$info['claveMateria']." ".$info['name']."</td>
			</tr>	
			<tr>
				<td>Cuatrimestre:</td>
				<td>".$info['semesId']."</td>
			</tr>
			<tr>
				<td>Grupo:</td>
				<td>".$info['groupA']."</td>
			</tr>
			<tr>
				<td>Periodo:</td>
				<td>".$info['initialDate']." - ".$info['finalDate']."</td>
			</tr>
			
			</table>
			<br>

			";

			$html .= "<table  width='100%' class='txtTicket'>";
			$html .= "<tr>";
			$html .= "<td style='width:11px'><center>Num.</center></td>";
			$html .= "<td ><center>Nombre</center></td>";
			$html .= "<td style='width:100px'><center>Calificación Final</center></td>";
			$html .= "<td style='width:100px'><center>Letra</center></td>";
			$html .= "</tr>";
			foreach($studentsRepeat as $key=>$aux){
				$html .= "<tr>";
				$html .= "<td>".($key+1)."</td>";
				$html .= "<td>".$aux['lastNamePaterno']." ".$aux['lastNameMaterno']." ".$aux['names']."</td>";
				$h =  $util->num2letras($aux['score']);
				
				if($aux['score'] == 0) 
				{
					$html .= "<td><center><font color='red'>NP</font></center></td>";
					$html .= "<td><center><font color='red'>NO PRESENTÓ</font></center></td>";
				}
				else if($aux['score'] < 7  and $info['majorName'] == 'MAESTRÍA')
				{
					if($isEnglish)
					{
						$html .= "<td><center><font color='red'>NA</font></center></td>";
						$html .= "<td><center><font color='red'>No Aprobado</font></center></td>";
					}
					else
					{
						$html .= "<td><center><font color='red'>".$aux['score']."</font></center></td>";
						$html .= "<td><center><font color='red'>".$h."</font></center></td>";
					}
				}
				else if($aux['score'] < 8  and $info['majorName'] == 'DOCTORADO')
				{
					if($isEnglish)
					{
						$html .= "<td><center><font color='red'>NA</font></center></td>";
						$html .= "<td><center><font color='red'>No Aprobado</font></center></td>";
					}
					else
					{
						$html .= "<td><center><font color='red'>".$aux['score']."</font></center></td>";
						$html .= "<td><center><font color='red'>".$h."</font></center></td>";
					}
				}
				else{
					if($isEnglish)
					{
						$html .= "<td><center>A</center></td>";
						$html .= "<td><center>Aprobado</center></td>";
					}
					else
					{
						$html .= "<td><center>".$aux['score']."</center></td>";
						$html .= "<td><center>".$h."</center></td>";
					}
				}
				$html .= "</tr>";
			}  
			$html .= "</table>";
			
			$html .= "
				
			<br>
			<br>
			<br>
			<center>
				
			
			<table width=100% align='center' style='border: none' class='txtTicket'>	
				<tr>
					<td colspan='2' align='center' style='border: none'>
					".$infoPersonal['profesion']." ".$infoPersonal['name']." ".$infoPersonal['lastname_paterno']." ".$infoPersonal['lastname_materno']."<br>
					Catedratico
					
					<br>
					<br>
					<br>
					</td>
				</tr>
				<tr>
					<td align='center' style='border: none'>
						".$infoFirma['director']."<br>
						Director Academico
					</td>
					<td align='center' style='border: none'> 
						".$infoFirma['controlEscolar']."<br>
						Servicios Escolares
					</td>
				</tr>
			</table>	
				
			</center>
		</div>
	</body>
	</html>
	";
	// echo $html;
	// exit;
	# Instanciamos un objeto de la clase DOMPDF.
	$mipdf = new DOMPDF();
	 
	# Definimos el tamaño y orientación del papel que queremos.
	# O por defecto cogerá el que está en el fichero de configuración.
	$mipdf ->set_paper("A4", "");
	 
	# Cargamos el contenido HTML.
	$mipdf ->load_html($html);
	 
	# Renderizamos el documento PDF.
	$mipdf ->render();
	 
	# Enviamos el fichero PDF al navegador.
	$mipdf ->stream('ActaDeCalificaciones.pdf',array('Attachment' => 0));
			


?>
