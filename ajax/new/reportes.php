<?php

include_once('../../init.php');
include_once('../../config.php');
include_once(DOC_ROOT . '/libraries.php');
session_start();
if ($_GET['opcion']) {
    $_POST['opcion'] = $_GET['opcion'];
}
switch ($_POST["opcion"]) {
    case 'cobach':
        include_once('reportes/cobach.php');
        break;
    case 'cobach-evaluaciones':
        include_once('reportes/cobach-evaluaciones.php');
        break;
    case 'transparencia':
        if ($_GET['tipo'] == 1) {
            include_once('reportes/transparencia.php');
        } else {
            include_once('reportes/transparencia-evaluaciones.php');
        }
        break;
    case 'auxilios':
        include_once('reportes/transparencia.php');
        break;
    case 'buen-gobierno':
    case 'gestion-gubernamental':
        if ($_GET['tipo'] == 1) {
            include_once('reportes/buen-gobierno.php');
        } elseif($_GET['tipo'] == 2) {
            include_once('reportes/buen-gobierno-evaluaciones.php');
        }else{
            include_once('reportes/buen-gobierno-promedios.php');
        }
        break;
    case 'licenciaturas':
        if ($_GET['tipo'] == 1) {
            include_once('reportes/licenciaturas.php');
        } else {
            include_once('reportes/licenciaturas-evaluaciones.php');
        }
        break; 
        
}
