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
                            {if in_array($subject.courseId, [7,8])} 
                                {if $subject.courseId == 7 && in_array($User.numControl,[ 20242510, 20242519, 20242526, 20242527, 20242529, 20242574, 20242575, 20242585, 20242589, 20242590, 20242617, 20242618, 20242620, 20242627, 20242629, 20242631, 20242636, 20242641, 20242645, 20242646, 20242647, 20242662, 20242680])}
                                    <br><br>
                                    <a href="{$WEB_ROOT}/pdf/diploma-500-1057.php?alumno={$User.userId}" target="_blank"
                                        class="btn btn-outline-light btn-fw btn-sm">
                                        <i class="far fa-list-alt"></i> Diploma
                                    </a>
                                {elseif in_array($User.numControl,[20240001, 20242498, 20242502, 20242504, 20242505, 20242506, 20242509, 20242511, 20242512, 20242513, 20242514, 20242515, 20242517, 20242522, 20242530, 20242532, 20242534, 20242535, 20242536, 20242537, 20242549, 20242555, 20242556, 20242563, 20242564, 20242565, 20242566, 20242567, 20242569, 20242570, 20242572, 20242580, 20242581, 20242583, 20242586, 20242588, 20242591, 20242595, 20242598, 20242602, 20242607, 20242609, 20242611, 20242613, 20242614, 20242615, 20242625, 20242650, 20242652, 20242653, 20242654, 20242655, 20242656, 20242657, 20242658, 20242659, 20242661, 20242664, 20242665, 20242669, 20242670, 20242671, 20242681, 20242700])}
                                    <br><br>
                                    <a href="{$WEB_ROOT}/pdf/diploma-500-1057.php?alumno={$User.userId}" target="_blank"
                                        class="btn btn-outline-light btn-fw btn-sm">
                                        <i class="far fa-list-alt"></i> Diploma
                                    </a>
                                {/if}
                            {/if} 
                            {if $subject.diploma}
                                <br><br>
                                <a href="{$WEB_ROOT}/pdf/diploma.php?alumno={$User.userId}&curso={$subject.courseId}&diploma={$subject.diploma}"
                                    target="_blank" class="btn btn-outline-light btn-fw btn-sm btn-block">
                                    <i class="far fa-list-alt"></i> Diploma
                                </a>
                            {/if}
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