<?php

include_once('init.php');
include_once('config.php');
include_once(DOC_ROOT . '/libraries.php');

// print_r($_GET);
// exit;
if (!isset($_SESSION)) {
	session_start();
}

if ($_GET['page'] == "procesar-pago") {
	if (!isset($_SESSION['User'])) {
		if ($_POST) {
			$referencia3d = $_POST['REFERENCIA3D'];
			$cobro_tarjeta = $conceptos->getCobroTarjeta($referencia3d);
			if (isset($cobro_tarjeta['session_id'])) {
				session_id($cobro_tarjeta['session_id']);
				session_start();
				$student->setUserId($cobro_tarjeta['userId']);
				$userInfo = $student->GetInfo();
				$user->setUsername($userInfo['controlNumber']);
				$user->setPassword($userInfo['password']);
				$user->do_login();
				setcookie('code', $_SESSION['User']['userId'], time() + 900);
				setcookie('type', $_SESSION['User']['type'], time() + 900);
			}
		}
	}
} else {
	if (isset($_COOKIE['code']) && isset($_COOKIE['type'])) {
		$data = $user->getLoginData($_COOKIE['code'], $_COOKIE['type']);
		$user->setUsername($data['username']);
		$user->setPassword($data['password']);
		$user->do_login();
		setcookie('code', '', time() - 60);
		setcookie('type', '', time() - 60);
	}
}

/* echo "<pre>";
print_r($_SESSION);
exit; */

if ((!isset($_SESSION['User'])) && $_GET['page'] != 'login' && $_GET['page'] != 'register' && $_GET['page'] != "registro" && $_GET['page'] != "registro-cobach" && $_GET['page'] != "recuperacion")
	header('Location: ' . WEB_ROOT . '/login');


//print_r($_SESSION);
//		unset($_SESSION['lastClick']);
//last click
//print_r($_SESSION);
/* if(time() > $_SESSION["lastClick"] + 90000 && $_GET["page"] != "login"  && $_GET["page"] != "register" && $_GET["page"] != "recuperacion"  && $_GET["page"] != "tv"  && $_GET["page"] != "make-test" && $_GET["page"] != "mantenimiento")
{
	unset($_SESSION['User']);
	unset($_SESSION['lastClick']);
	header("Location: ".WEB_ROOT."/login");
} */

if ($_SESSION["User"]) {
	$_SESSION["lastClick"] = time();
}

$User = $_SESSION['User'];

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
	'registro-cobach'
);

$mensaje = "<h1>Recordatorio Importante: Fecha de pago para tu posgrado.</h1><p>Es un placer tenerte como parte de nuestra comunidad educativa. Queremos recordarte la importancia de mantener tus pagos al día para garantizar un acceso ininterrumpido a nuestra plataforma educativa.</p><p>Por ello te recordamos los pagos correspondientes al posgrado en el que te encuentras inscrito deben realizarse en los <strong>primeros 10 días de cada mes</strong>, siguiendo el calendario de pagos establecido por nuestro Instituto.</p><p>Estar al corriente con tus pagos es esencial para aprovechar al máximo tus estudios. Si tienes alguna pregunta o necesitas asistencia adicional relacionada con tus pagos, no dudes en ponerte en contacto con nuestro Departamento de Contabilidad y Finanzas. Puedes contactarnos al teléfono 961 125 15 08 Extensión 116, de lunes a viernes, en horario de 08:00 a 16:00 horas. Estamos aquí para ayudarte en todo momento.</p><p>Agradecemos tu compromiso con tu educación y tu dedicación. Tu éxito es nuestro objetivo y estamos aquí para apoyarte en cada paso del camino.</p><p>IAP Chiapas</p>"; 

if (!in_array($_GET['page'], $pages) && $_GET['page'] != "logout") {
	$_GET['page'] = "homepage";
}
$pagesBlackList = ['modulos-curricula', 'view-modules-student', 'calendar-modules-student'];
if ($User['bloqueado'] == 1) { //Comprobamos que realmente tenga un pago adeudado
	$student->setUserId($_SESSION["User"]["userId"]);
	$pagoPendiente = $student->pago_pendiente();
	if (!$pagoPendiente) { //Si no cuenta con pago pendiente, se desbloquea al usuario
		$User['bloqueado'] = 0;
	} else {
		$mensaje = "<h2 class='text-danger'><strong>ESTIMADO ALUMNO</strong></h2><p>Lamentamos informarte que tu acceso al sistema de educación ha sido bloqueado debido a saldos pendientes en tu cuenta. Para poder desbloquear tu acceso y continuar con tu proceso educativo, te pedimos que regularices tu situación de pago lo antes posible.</p><p>Por favor, sigue estos pasos:</p><ol style='text-align: justify; font-size: 1rem;'><li>Verifica el detalle de tus colegiaturas pendientes en el módulo de 'Finanzas' de este sistema.</li><li>Realiza el pago correspondiente a través de los métodos de pago disponibles.</li><li>Una vez realizado el pago, permite un período máximo de 48 horas para que el sistema actualice tu estado de cuenta.</li><li>Una vez que tu pago haya sido procesado y tu situación esté regularizada, podrás acceder nuevamente al sistema de educación y continuar con tus estudios sin interrupciones.</li></ol><p>Si tienes alguna pregunta o necesitas asistencia adicional, no dudes en ponerte en contacto con nuestro Departamento de Contabilidad y Finanzas, al 961 125 15 08 Ext. 116 en un horario de 08:00 a 16:00 horas de lunes a viernes.</p><p>Agradecemos tu pronta atención y compromiso con tu educación.</p><p>Atentamente, <br>IAP Chiapas</p";
	}
}
$smarty->assign("mensaje", $mensaje);
if (in_array($_GET['page'], $pagesBlackList) && $User['bloqueado'] == 1 && $_GET['page'] != "logout") {
	$_GET['page'] = "homepage";
}

// echo $_GET['page'];
// exit;

$smarty->assign('positionId', $User['positionId']);

include_once(DOC_ROOT . '/modules/user.php');
include_once(DOC_ROOT . '/modules/' . $_GET['page'] . '.php');

$smarty->assign('page', $_GET['page']);
$smarty->assign('section', $_GET['section']);

if ($User['userId'])
	$AccessMod = $user->GetModulesAccess();

$smarty->assign('AccessMod', $AccessMod);
$smarty->assign('User', $User);
// print_r($User);
$includedTpl =  $_GET['page'];
if ($_GET['section']) {
	$includedTpl =  $_GET['page'] . "_" . $_GET['section'];
}
$smarty->assign('includedTpl', $includedTpl);

//print_r($_GET); exit;

if (isset($_GET['vp'])) {
	$smarty->assign("vistaPrevia", $_GET['vp']);
} else {
	$smarty->assign("vistaPrevia", 0);
}

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
// print_r($AccessMod);
