<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de Educaci&oacute;n en Linea | IAP Chiapas</title>
        <link href="{$WEB_ROOT}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        {* New styles *}
        <link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/css/style.css">
        <link rel="shortcut icon" href="{$WEB_ROOT}/images/logos/iconIap.png" />
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth">
                    <div class="row w-100">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left p-5">
                                <div class="row d-flex justify-content-center">
                                    <div class="brand-logo">
                                        <img src="{$WEB_ROOT}/images/logos/Logo_3.png" width="200px">
                                    </div>
                                    <h4>Recuperación de Datos de Acceso</h4>
                                    <h6 class="font-weight-light text-center">Ingresa el correo electrónico con el que te diste de alta, por ese medio te enviaremos tus datos de acceso.</h6>
                                </div>
                                <form class="pt-3 form" method="POST" id="form_recuperacion" action="{$WEB_ROOT}/ajax/new/recuperacion.php">
                                    <input type="hidden" name="type" value="recupera" />
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" autocomplete="off" placeholder="Correo" required />
                                        <span class="invalid-feedback"></span>
                                    </div>
                                    <div id="loader" ></div>
			                        <div id="divMsj" class="alert alert-info" style="display:none"></div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                            Recuperar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {* Scripts *}
        <script src="{$WEB_ROOT}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        {* END CORE PLUGINS *}
        {* BEGIN PAGE LEVEL PLUGINS *}
        <script src="{$WEB_ROOT}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        {* END PAGE LEVEL PLUGINS *}
        {* BEGIN THEME GLOBAL SCRIPTS *}
        <script src="{$WEB_ROOT}/assets/global/scripts/app.min.js" type="text/javascript"></script>
        {* END THEME GLOBAL SCRIPTS *}
        {* BEGIN PAGE LEVEL SCRIPTS *}
        <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js" type="text/javascript"></script>
        <script src="{$WEB_ROOT}/assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
        {include file="{$DOC_ROOT}/templates/config.tpl"}
        <script src="{$WEB_ROOT}/javascript/new/functions.js?{$timestamp}" type="text/javascript"></script>
        {* New scripts *}
        <!--script src="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script-->
    </body>
</html>