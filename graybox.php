<?php

include_once('init.php');
include_once('config.php');
include_once(DOC_ROOT . '/libraries.php');

// print_r($_GET);
// exit;
if (!isset($_SESSION)) {
    session_start();
}

$pages = array(
    'login',
    'logout',
    'homepage',
    'student',
    'major',
    'speciality',
    'position',
    'personal',
    'schedule',
    'group',
    'group-subject',
    'semester',
    'assign',
    'institution',
    'role',
    'periodo',
    'subject-group',
    'typetest',
    'gradereport',
    'gradereport-user',
    'gradescore-user',
    'schedule-time',
    'schedule-personal',
    'schedule-subject',
    'schedule-student',
    'schedule-students',
    'schedule_test',
    'schedule-groups',
    'schedule-group',
    'classroom',
    'cancel-code',
    'report-excel',
    'report-redi',
    'report-cancel',
    'report-regular',
    'report-desercion',
    'report-calificacion',
    'school-type',
    'group-user',
    'ficha',
    'study-constancy',
    'kardex-calificacion',
    'register',
    'recuperacion',

    //new
    "add-comment",
    "new-subject",
    "edit-subject",
    "open-subject",
    "history-subject",
    "new-module",
    "edit-module",

    "edit-course",
    "activities-course",
    'subject',

    //alumn
    "curricula",
    "alumn-services",

    "payments",
    "invoices",
    "invoices-student",

    "new-payment",
    "view-payments",

    "view-modules-course",
    "add-modules-course",
    "edit-modules-course",

    "add-activity",
    "edit-activity",
    "view-description-activity",


    "configuracion-examen",
    "edit-question",

    "view-modules-course-student",
    "view-modules-student",
    "presentation-modules-student",
    "information-modules-student",
    "calendar-modules-student",
    "examen-modules-student",
    "calendar-image-modules-student",
    "resources-modules-student",

    "forum-modules-student",
    "forumsub-modules-student",
    "add-topic",
    "add-reply",
    "team-modules-student",

    "add-resource",
    "edit-resource",

    "config-teams",
    "score-activity",

    "upload-homework",
    "make-test",
    "student-curricula",
    "ver-sabana-course",

    "add-noticia",
    "tv",
    "recorded",
    "recording",

    "profesion",

    //facturacion
    'admin-folios',
    'datos-generales',
    'sistema',

    //reportes
    'reporte-general',
    'reporte-alumno-modulo',
    'edit-student',
    'add-alumno-admin',
    'zoom',
    'view-solicitud',
    'solicitud-constancia',
    'add-baja',
    'add-calificacion',
    'referencia-bancaria',
    'view-boleta',
    'formato-reinscripcion',
    'add-documento',
    'add-concepto',
    'info',
    'cancelar-solicitud',
    'concepto-pago',
    'nuevo-mensaje',
    'add-inbox',
    'confirma-baja',
    'test-docente',
    'nuevo-inbox',
    'add-docdocente',
    'add-docalumno',
    'info-docente',
    'doc-docente',
    'doc-alumno',
    'add-docente-admin',
    'cat-doc-admin',
    'add-cat-doc-docente',
    'add-cat-doc-docente-add',
    'add-cat-doc-alumno',
    'add-cat-doc-alumno-add',
    'add-repositorio',
    'val',
    'carta',
    'materias',
    'eval',
    'editar-contra',
    'cedula-contra',
    'down-contrato',
    'edit-costo',
    'up-plan',
    'up-acta',
    'down-contrato-doc',
    'comentario-solicitud',
    'validarpago-adjuntar',
    'view-curricula',
    'view-periodos',
    'down-plan',
    'encuadre',
    'rubrica',
    'view-cuatri',
    'add-msj',
    'contra',
    'view-perfil',
    'aviso',
    'add-activity-c',
    'informe',
    'add-resource-c',
    'calendar-form',
    'edit-calendar-form',
    'calendar-student',
    'history-calendar',
    'student-repeat',
    'qualifications-course',
    'certificates',
    'certificates-course',
    'titulacion',
    'indicadores',
    'acta-examen-course',
    'constancia-sencilla-course',
    'constancia-calificaciones-course',
    'niveles-ingles',
    "estudiante-informacion-adicional",
    "ficha-registro",
    'foro-estadisticas',
    'conceptos',
    'edit-comment',
    'constancias'
);

if (!in_array($_GET['page'], $pages) && $_GET['page'] != "logout") {
    $_GET['page'] = "homepage";
}

if (!isset($_SESSION['User'])) { //Si no existe sesión
    if (!in_array($_GET['page'], ['login', 'registro-cobach', 'recuperacion'])) { //Y no está en estas páginas
        header('Location: ' . WEB_ROOT . "/login"); //Lo mandamos al login
    }
} else { //Existe sesión
    $User = $_SESSION['User'];
    $student->setUserId($User["userId"]);
    if ($_GET['page'] != "homepage") { //Si es distinto del homepage checamos los permisos
        include_once(DOC_ROOT . '/modules/user.php');
    }
}
 
$smarty->assign('positionId', $User['positionId']);  
include_once(DOC_ROOT . '/modules/' . $_GET['page'] . '.php');

$smarty->assign('page', $_GET['page']);
$smarty->assign('section', $_GET['section']); 
$smarty->assign('User', $User);

$includedTpl =  $_GET['page'];
if ($_GET['section']) {
    $includedTpl =  $_GET['page'] . "_" . $_GET['section'];
}
$smarty->assign('includedTpl', $includedTpl);  
$smarty->assign('lang', $lang);
$smarty->assign('timestamp', time());

ini_set("display_errors", "ON");
$showErrors = "E_ALL";
error_reporting($showErrors);
$smarty->display(DOC_ROOT . '/templates/graybox.tpl');
