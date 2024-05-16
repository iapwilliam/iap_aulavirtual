<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Sistema de Educación en Linea | IAP Chiapas</title>

	{*<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />*}
	<link href="{$WEB_ROOT}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
		type="text/css" />
	<link href="{$WEB_ROOT}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
		type="text/css" />
	{*<link href="{$WEB_ROOT}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />*}
	<link href="{$WEB_ROOT}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
		type="text/css" />
	{*<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">*}
	{* END GLOBAL MANDATORY STYLES *}
	{* BEGIN THEME GLOBAL STYLES *}
	{*<link href="{$WEB_ROOT}/assets/global/css/components-md.css" rel="stylesheet" id="style_components" type="text/css" />*}
	<link href="{$WEB_ROOT}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
	{* END THEME GLOBAL STYLES *}
	{if ($page == 'homepage' && $User.type == 'student') || ($page == 'homepage' && $User.type == 'Docente') || $page == 'docente'}
		<link href="{$WEB_ROOT}/assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
	{/if}
	{if $page == 'inbox' or $page == 'reply-inbox' or $page == 'view-inbox'}
		<link href="{$WEB_ROOT}/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	{/if}
	{* BEGIN THEME LAYOUT STYLES *}
	{*<link href="{$WEB_ROOT}/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />*}
	{*<link href="{$WEB_ROOT}/assets/layouts/layout/css/themes/light2.css" rel="stylesheet" type="text/css" id="style_color" />*}
	{*<link href="{$WEB_ROOT}/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />*}
	<link href="{$WEB_ROOT}/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet"
		type="text/css" />
	<link href="{$WEB_ROOT}/assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet"
		type="text/css" />
	{* END THEME LAYOUT STYLES *}
	<link rel="shortcut icon" href="{$WEB_ROOT}/images/iconIap.png" />
	<link href="{$WEB_ROOT}/GreyBox/greybox/gb_styles.css" rel="stylesheet" type="text/css" />
	<link href="{$WEB_ROOT}/css/inbox.css" rel="stylesheet" type="text/css" />
	{*<link href="{$WEB_ROOT}/css/radiobutton.css" rel="stylesheet" type="text/css"  />*}
	{*<style>
			.modal-dialog {
				width: 70%;
			}
			i.icon-green {
				color: #32c5d2;
			}
		</style>*}
	<link href="{$WEB_ROOT}/assets/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
	{if $page == 'reply-inbox' or 
			$page == 'view-inbox' or
			$page == 'edit-modules-course' or
			$page == 'info-docente' or 
			$page == 'lst-docentes' or 
			$page == 'prog-materia' or 
			$page == 'report-docentes' or 
			$page == 'perfil' or 
			$page == 'materias'}
	<style type="text/css">
		.btn-file {
			position: relative;
			overflow: hidden;
			border: 1px solid #00BCD4;
			color: #00BCD4;
		}

		.btn-file input[type=file] {
			position: absolute;
			top: 0;
			right: 0;
			min-width: 100%;
			min-height: 100%;
			font-size: 100px;
			text-align: right;
			filter: alpha(opacity=0);
			opacity: 0;
			outline: none;
			background: red;
			cursor: inherit;
			display: block;
		}
	</style>
	{/if}
	{* New styles *}
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/iconfonts/mdi/css/materialdesignicons.min.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/css/vendor.bundle.base.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/jodit/build/jodit.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/flatpickr/flatpickr.min.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/css/style.css">
	<link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/fancybox/dist/jquery.fancybox.min.css">
	<link rel="shortcut icon" href="{$WEB_ROOT}/images/logos/iconIap.png" />
	{* End new styles *}
	{if $User.type ne "student"}
		<link href="https://cdn.datatables.net/v/bs4/dt-1.13.5/r-2.5.0/datatables.min.css" rel="stylesheet" />
		<link rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	{/if}
	<meta name="google-site-verification" content="f6Gp4p1F2x8QqSyRTrGHSaW_6fzWtg2St5trtIZ4wcI" />
</head>

<body>
	<div class="container-scroller">
		{* Header *}
		{include file="new/header.tpl"}
		<div class="container-fluid page-body-wrapper">
			{* Sidebar *}
			{if $vistaPrevia eq 1}
				{include file="new/sidebar_vp.tpl"}
			{else}
				{if (($User.type ne "Docente") and ($User.type ne "student") and !in_array($page,['register', 'registro', 'registro-cobach', 'registro-transparencia', 'registro-primeros-auxilios']))}
					{include file="new/sidebar.tpl"}
				{/if}
			{*if (($User.type eq "Docente") or ($User.type eq "student"))}
						{include file="new/sidebar_ds.tpl"}
					{/if*}
			{/if}
			{* End sidebar *}
			<div class="main-panel"
				{if (($User.type eq "Docente") or ($User.type eq "student") or in_array($page,['register', 'registro', 'registro-cobach', 'registro-transparencia', 'registro-primeros-auxilios']))}
				style="width:100% !important;" {/if}>
				{* Container *}
				<div class="content-wrapper">
					{include file="new/container.tpl"}
				</div>
				{* End container *}
				<div id="frmModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
					aria-hidden="true"></div>
				{* Footer *}
				{include file="new/footer.tpl"}
				{* End footer *}
			</div>
		</div>
	</div>

	{* New scripts *}
	<script src="{$WEB_ROOT}/assets/vcz/vendor/js/vendor.bundle.base.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/js/vendor.bundle.addons.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/off-canvas.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/hoverable-collapse.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/misc.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/fontawesome/js/all.min.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/bootbox.min.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/jodit/build/jodit.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/flatpickr/flatpickr.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/dashboard.js?v={$timestamp}"></script>
	{* End new scripts *}

	{* Scripts headers *}
	<script type="text/javascript" src="{$WEB_ROOT}/tinymce/tiny_mce.js"></script>
	<script type="text/javascript">
		var GB_ROOT_DIR = "{$WEB_ROOT}/GreyBox/greybox/";
	</script>
	<script type="text/javascript" src="{$WEB_ROOT}/GreyBox/greybox/AJS.js"></script>
	<script type="text/javascript" src="{$WEB_ROOT}/GreyBox/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="{$WEB_ROOT}/GreyBox/greybox/gb_scripts.js"></script>
	<script type="text/javascript" src="{$WEB_ROOT}/javascript/inbox.js"></script>
	{* End scripts headers *}
	{* BEGIN CORE PLUGINS *}
	<script src="{$WEB_ROOT}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
	</script>
	<script src="{$WEB_ROOT}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
	</script>
	{* END CORE PLUGINS *}
	<script>
		//$j = jQuery.noConflict();
		//$.noConflict(true);
	</script>
	{* BEGIN THEME GLOBAL SCRIPTS *}
	<script src="{$WEB_ROOT}/assets/global/scripts/app.js" type="text/javascript"></script>
	{* END THEME GLOBAL SCRIPTS *}
	{* BEGIN THEME LAYOUT SCRIPTS *}
	<script src="{$WEB_ROOT}/assets/layouts/layout/scripts/layout.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js?sdfdddddasd"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js?jjsadasd"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
	{include file="{$DOC_ROOT}/templates/config.tpl"}
	<script src="{$WEB_ROOT}/javascript/new/functions.js?{$timestamp}" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript">
	</script>
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript">
	</script>
	{*<script src="{$WEB_ROOT}/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>*}
	<script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"
		type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
	{if $page eq "calendar-image-modules-student"}
		<script src="{$WEB_ROOT}/assets/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
		<script src="{$WEB_ROOT}/assets/fullcalendar/app.js" type="text/javascript"></script>
	{/if}
	{if $User.type ne "student"}
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
		<script>
			moment.locale('es', {
				months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split(
					'_'),
				monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
				weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
				weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
				weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
			});
		</script>
		<script src="https://cdn.datatables.net/v/bs4/dt-1.13.5/r-2.5.0/datatables.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	{/if}
	<script src="{$WEB_ROOT}/javascript/new/{$page}.js?{$timestamp}" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/pages/scripts/profile.min.js" type="text/javascript"></script>
	<script src="{$WEB_ROOT}/assets/vcz/js/general.js?v={$timestamp}"></script>
	{if $page eq "edit-module" or $mJodit eq "active"}
		<script type="text/javascript">
			$(function() {
				$('textarea').each(function() {
					new Jodit(this, {
						language: "es",
						toolbarButtonSize: "small",
						autofocus: true,
						toolbarAdaptive: false
					});
					console.log("Activado");
				});
			});
		</script>
	{/if} 
	{if $User.type eq "student" and $page eq "homepage"} 
		{if $User.announcement neq true && $referencia > 0}
			<style>
				.swal2-show {
					width: 850px !important;
				}

				.swal2-html-container p {
					text-align: justify;
					font-size: 1.2rem;
				}
			</style>
			<script>
				Swal.fire({  
					html: "{$mensaje}",
					showCancelButton: false,
					confirmButtonColor: '#58ff85',
					cancelButtonColor: '#ff4545',
					confirmButtonText: 'Enterado'
				});
			</script>
		{/if}
		<script>
			/* ésto comprueba la localStorage si ya tiene la variable guardada */
			function compruebaAceptaCookies() {
				if (localStorage.aceptaCookies != 'true') {
					$(".cookies").removeClass('d-none');
				}
			}

			/* aquí guardamos la variable de que se ha
		aceptado el uso de cookies así no mostraremos
		el mensaje de nuevo */
			function aceptarCookies() {
				localStorage.aceptaCookies = 'true';
				$(".cookies").addClass('d-none');
			}

			/* ésto se ejecuta cuando la web está cargada */
			$(document).ready(function() {
				compruebaAceptaCookies();
			});
		</script>
	{/if}
	{if $page eq 'pagar'}
		{if $processing}
			<script>
				Swal.fire({
					html: '<h2><i class="fas fa-spinner fa-pulse"></i> Espere por favor...</h2>',
					showCancelButton: false,
					showConfirmButton: false
				});
			</script>
		{/if}
	{/if}
</body>

</html>