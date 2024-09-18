<?php

include_once('init.php');
include_once('config.php');
include_once(DOC_ROOT . '/libraries.php');

// print_r($_GET);
// exit;
if (!isset($_SESSION)) {
	if ($_GET['page'] == "make-test") {
		ini_set('session.gc_maxlifetime', 4600);
		session_set_cookie_params(4600);
	}
	session_start();
}
$pages = array(
	'prueba',
	'login',
	'logout',
	'personal1',
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
	'subject',
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
	'docente',

	//new
	"new-subject",
	"edit-subject",
	"open-subject",
	"history-subject",
	"new-module",
	"edit-module",

	"edit-course",
	"activities-course",

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
	//"presentation-modules-student",
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
	"add-comment",

	"add-noticia",
	"tv",
	"recorded",

	"profesion",

	//facturacion
	'admin-folios',
	'datos-generales',
	'sistema',

	//reportes
	'reporte-general',
	'reporte-alumno-modulo',
	'edit-student',
	'report-card',
	'transcript-cc',
	'transcript-sc',
	'bank-reference',
	'unsubscribe',
	'report-card-teacher',
	'solicitud',
	'view-solicitud',
	'referencia-bancaria',
	'score-activity-new',
	'reinscripcion',
	'concepto',
	'sincronizar',
	'ver-calendario',
	'estatus-financiero',
	'mensaje',
	'add-mensaje',
	'inbox',
	'reply-inbox',
	'test-docente',
	'info-docente',
	'view-inbox',
	'doc-docente',
	'add-docdocente',
	'doc-alumno',
	'repositorio',
	'lst-docentes',
	'cat-doc-docente',
	'add-cat-doc-docente',
	'cat-doc-alumno',
	'materias',
	'vehiculos',
	'report-materia',
	'report-docentes',
	'doc-mat',
	'tabla-costo',
	'prog-academico',
	'prog-materia',
	'validarpago-adjuntar',
	'msj',
	'personal-academico',
	'perfil',
	'grupo',
	'aviso',
	'calification',
	'cobranza-calendario',
	'configurar-calendario',
	'calendar-form',
	'edit-calendar-form',
	'becas-calendario',
	'pagos-calendario',
	'history-calendar',
	'finanzas',
	'reglamento',
	'modulos-curricula',
	'migrupo',
	'notificaciones',
	'modulos-recursar',
	'mantenimiento',
	'certificates',
	'titulacion',
	'indicadores',
	'acta-examen-course',
	'niveles-ingles',
	'configuracion-certificados',
	'reporte-indicadores',
	'reportes-extras',
	'conceptos',
	'edit-comment',
	'datos-fiscales',
	'solicitudes-pagos',
	'reporte-pagos',
	'pagar',
	'procesar-pago',
	'mi-credencial-digital',
	'credenciales',
	'registro',
	'reporte-becas',
	'registro-cobach',
	//'registro-transparencia',
	'reporte-licencias',
	'reporte-transparencia',
	'registro-primeros-auxilios',
	'reporte-auxilios',
	'registro-igualdad',
	//'registro-responsabilidad', 
	'registro-simulador',
	'reporte-buen-gobierno',
	//'registro-gestion-gubernamental',
	'reporte-gestion-gubernamental',
);
if (!in_array($_GET['page'], $pages) && $_GET['page'] != "logout") {
	$_GET['page'] = "homepage";
}

if (!isset($_SESSION['User'])) { //Si no existe sesión
	if (!in_array($_GET['page'], [
		'login',
		'registro-cobach',
		'recuperacion',
		'registro',
		'registro-transparencia',
		'registro-primeros-auxilios',
		'registro-igualdad',
		'registro-responsabilidad',
		'registro-simulador',
		'registro-gestion-gubernamental'
	])) { //Y no está en estas páginas
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
$smarty->assign('rand', rand());
ini_set("display_errors", "ON");
$showErrors = "E_ALL";
error_reporting($showErrors);
if ($includedTpl == 'login') {
	$smarty->display(DOC_ROOT . '/templates/login_new.tpl');
} else if ($includedTpl == 'recuperacion') {
	$smarty->display(DOC_ROOT . '/templates/recuperacion.tpl');
} else if ($includedTpl == 'mantenimiento') {
	$smarty->display(DOC_ROOT . '/templates/mantenimiento.tpl');
} else {

	$smarty->display(DOC_ROOT . '/templates/index_new.tpl');
}
