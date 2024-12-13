<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistema de Educaci&oacute;n en Linea | IAP Chiapas</title>
    <link href="{$WEB_ROOT}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    {* New styles *}
    <link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{$WEB_ROOT}/assets/vcz/css/style.css">
    <link rel="shortcut icon" href="{$WEB_ROOT}/images/logos/iconIap.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth bg-white">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="row d-flex justify-content-center">
                            <div class="brand-logo">
                                <img src="{$WEB_ROOT}/images/logos/logo-humanismo.webp" width="300px">
                            </div>
                        </div>
                        <div class="auth-form-light text-left p-5" style="box-shadow: 0px 2px 7px 7px #D2D2D2;">
                            <div class="row d-flex justify-content-center">
                                {*<div class="brand-logo">
                                        <img src="{$WEB_ROOT}/images/logos/Logo_3.png" width="200px">
                                    </div>*}
                                <h4>Sistema de Educación en Línea</h4>
                                <h6 class="font-weight-light">Ingresa a tu cuenta.</h6>
                                <div class="alert alert-danger d-none">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <span> Tu usuario o contraseña son incorrectas. Favor de verificarlas. </span>
                                </div>
                            </div>
                            <form id="frmLogin" class="pt-3" method="POST">
                                <input type="hidden" name="option" value="doLogin" />
                                <div class="form-group">
                                    <input type="text" id="username" name="username"
                                        class="form-control form-control-lg" placeholder="Usuario" />
                                </div>
                                <div class="form-group input-group">
                                    <input type="password" id="passwd" name="passwd"
                                        class="form-control form-control-lg" placeholder="Contraseña" />
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-sm btn-primary" id="showPassword"><img id="eyePassword" src="{$WEB_ROOT}/images/new/icons/ojo_abierto.svg" width="20"></button>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="button" onclick="DoLogin()"
                                        class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">
                                        Ingresar
                                    </button>
                                </div>
                                <div class="my-2 d-flex justify-content-center align-items-center">
                                    <a href="recuperacion" class="auth-link text-black">¿Olvidaste tu contraseña?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    {*<div class="col-lg-12">
                            <div class="row d-flex justify-content-between">*}
                    <img src="{$WEB_ROOT}/images/new/curricula/de-bg.svg" class="img-fluid img-login"
                        style="max-width: 300px; position: absolute; bottom: 0; left: 0;" />
                    <img src="{$WEB_ROOT}/images/new/curricula/dap-bg.svg" class="img-fluid img-login"
                        style="max-width: 300px; position: absolute; bottom: 0; right: 0;" />
                    {*</div>
                        </div>*}
                </div>
            </div>
        </div>
    </div>
    {* Scripts *}
    <script src="{$WEB_ROOT}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <script src="{$WEB_ROOT}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
    </script>
    {* END CORE PLUGINS *}
    {* BEGIN PAGE LEVEL PLUGINS *}
    <script src="{$WEB_ROOT}/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript">
    </script>
    <script src="{$WEB_ROOT}/assets/global/plugins/jquery-validation/js/additional-methods.min.js"
        type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript">
    </script>
    {* END PAGE LEVEL PLUGINS *}
    {* BEGIN THEME GLOBAL SCRIPTS *}
    <script src="{$WEB_ROOT}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    {* END THEME GLOBAL SCRIPTS *}
    {* BEGIN PAGE LEVEL SCRIPTS *}
    <script src="{$WEB_ROOT}/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js"
        type="text/javascript"></script>
    <script src="{$WEB_ROOT}/assets/pages/scripts/login-4.min.js" type="text/javascript"></script>
    {include file="{$DOC_ROOT}/templates/config.tpl"}
    <script src="{$WEB_ROOT}/javascript/functions.js?{$timestamp}" type="text/javascript"></script>
    <script src="{$WEB_ROOT}/javascript/new/{$page}.js?{$timestamp}" type="text/javascript"></script>
    {* New scripts *}
    <!--script src="{$WEB_ROOT}/assets/vcz/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script-->
</body>

</html>