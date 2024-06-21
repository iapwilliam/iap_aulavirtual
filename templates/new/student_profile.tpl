<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span>
        Bienvenido
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>IAP Chiapas
                <i class="mdi mdi-checkbox-marked-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-3">
        {include file="new/card_student.tpl"}
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                {if $msjC eq 'si'}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>El perfil se actualizo correctamente.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                {/if}
                {if $msjCc eq 'si'}
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>La contraseña se actualizó correctamente.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                {/if}
            </div>
        </div>
        {* If Actualizado *}

        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-school"></i>
                    </span>
                    Currícula Activa
                </h3>
            </div>
            {foreach from=$activeCourses item=subject}
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card card-img-holder text-white bg-gradient-primary">
                        <div class="text-center">
                            <a href="{$WEB_ROOT}/modulos-curricula/id/{$subject.courseId}" title="Módulos de la Currícula">
                                {if $subject.icon eq ''}
                                    <i class="far fa-image fa-6x text-white mt-4"></i>
                                {else}
                                    <img class="card-img-top" src="{$WEB_ROOT}/images/new/curricula/{$subject.icon}" alt="">
                                {/if}
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3">{$subject.major_name}
                                <i class="fas fa-chalkboard float-right fa-lg"></i>
                            </h4>
                            <p class="mb-3">
                                {$subject.subject_name}<br>
                                <small>Grupo: {$subject.group} ({if $subject.modality eq 'Local'}Escolar
                                    {else}No
                                    Escolar{/if})<br>
                                    Periodo: {$subject.initialDate|date_format:"%d-%m-%Y"} -
                                    {$subject.finalDate|date_format:"%d-%m-%Y"}</small><br>
                                {if $subject.situation eq 'Ordinario'}
                                    <small>Módulos: {$subject.courseModule}</small>
                                {/if}
                                {if $subject.situation eq 'Recursador'}
                                    <small>Recursando Materia(s)</small>
                                {/if}
                            </p>
                            <div class="text-center">
                                <a href="{$WEB_ROOT}/modulos-curricula/id/{$subject.courseId}"
                                    title="Módulos de la Currícula" class="btn btn-outline-light btn-fw btn-sm">
                                    <i class="fas fa-link"></i> Ver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            {foreachelse}
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="far fa-frown fa-lg"></i> <strong>¡Lo sentimos!</strong> No Cuentas Con Currícula
                        {$tipo_curricula}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            {/foreach}
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-info text-white mr-2">
                        <i class="mdi mdi-school"></i>
                    </span>
                    Currícula Finalizada
                </h3>
            </div>
            {foreach from=$finishedCourses item=subject}
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card card-img-holder text-white bg-gradient-info">
                        <div class="text-center">
                            {if $subject.icon eq ''}
                                <i class="far fa-image fa-6x text-white mt-4"></i>
                            {else}
                                <img class="card-img-top" src="{$WEB_ROOT}/images/new/curricula/{$subject.icon}" alt="">
                            {/if}
                        </div>
                        <div class="card-body">
                            <h4 class="font-weight-normal mb-3">{$subject.major_name}
                                <i class="fas fa-chalkboard float-right fa-lg"></i>
                            </h4>
                            <p class="mb-3">
                                {$subject.subject_name}<br>
                                <small>
                                    Grupo: {$subject.group} 
                                    Periodo: {$subject.initialDate|date_format:"%d-%m-%Y"} -
                                    {$subject.finalDate|date_format:"%d-%m-%Y"}
                                </small><br>
                                {if $subject.situation eq 'Ordinario'}
                                    <small>Módulos: {$subject.courseModule}</small>
                                {/if} 
                            </p>
                        </div>
                    </div>
                </div>
            {foreachelse}
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        No Cuentas Con Currícula Finalizadas
                        {$tipo_curricula}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
</div>
<div class="cookies d-none">
    <div class="container" style="background: #fff; border-radius: 20px 20px 0 0;">
        <div class="row">
            <div class="col-md-12">
                <div style=" padding: 20px 40px; text-align: justify; font-size: 18px;">
                    <h5 style="font-size:20px; text-align:center; font-weight: 700;">Esta página web hace uso de cookies
                    </h5>
                    Las cookies necesarias ayudan a hacer una página web utilizable activando funciones básicas como la
                    navegación en la página y el acceso a áreas seguras. La página web no puede funcionar adecuadamente
                    sin estas cookies.
                </div>
            </div>
            <div class="col-md-12 text-center mb-3">
                <button class="btn btn-success" type="button" onclick="aceptarCookies()">Aceptar Cookies</button>
                <a class="btn btn-info" target="_blank" href="https://iapchiapas.edu.mx/aviso_privacidad">Aviso de
                    privacidad</a>
            </div>
        </div>
    </div>
</div>