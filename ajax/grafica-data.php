<?php
include_once('../init.php');
include_once('../config.php');
include_once(DOC_ROOT . '/libraries.php');

session_start();

header("Content-type: text/x-json");

$lst = $activity->enumerateActividadCalendario($_GET['courseModuleId']);
foreach ($lst as $key => $aux) {

	$aux['description'] = htmlspecialchars_decode($aux['description']);
	switch ($key) {
		case 0:
			$color  = "#884EA0";
			break;

		case 1:
			$color  = "#9d2222";
			break;

		case 2:
			$color  = "#76D7C4";
			break;


		case 3:
			$color  = "#85C1E9";
			break;

		case 4:
			$color  = "#AF7AC5";
			break;

		case 5:
			$color  = "#F8C471";
			break;

		case 6:
			$color  = "#45B39D";
			break;

		case 7:
			$color  = "#5D6D7E";
			break;

		case 8:
			$color  = "#21618C";
			break;

		case 9:
			$color  = "#3a87ad";
			break;


		default:
			$color  = "#";
			break;
	}

	$resources[] = array('title' => ($aux['resumen']), 'start' => $aux["initialDate"], 'end' => $aux["fechaFinal"], 'color' => $color);
}

// echo 'dd';
// echo '<pre>'; print_r($lst);
// exit;
print json_encode($resources);
