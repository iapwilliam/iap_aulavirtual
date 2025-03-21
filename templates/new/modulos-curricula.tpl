<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-school"></i>
        </span>
        Currícula
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>IAP Chiapas
                <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>

<div class="card mb-4">
    {*<div class="card-header bg-primary text-white"></div>*}
    <div class="card-body">
        <h3 class="text-center">{$infoCourses.major_name|upper}: {$infoCourses.subject_name|upper} - GRUPO:
            {$infoCourses.group}
        </h3>
        <div id="accordion">
            {for $cuatrimestre = $alta to $baja}
                <div class="card">
                    <div class="card-header collapsed card-link pointer text-white bg-primary" data-toggle="collapse"
                        href="#collapse{$cuatrimestre}">
                        Fase {$cuatrimestre} <i class="fas fa-chevron-circle-down float-right"></i>
                    </div>
                    <div id="collapse{$cuatrimestre}" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                            {foreach from=$subjects item=subject}
                                {if $cuatrimestre eq $subject.semesterId}
                                    <div class="card border-secondary mb-2 border border-info">
                                        <div class="card-header bg-info text-white">
                                            {$subject.name}
                                            <span class="badge badge-dark float-right">
                                                Módulo
                                            </span>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-md-4 text-center">
                                                    <h5 class="card-title"><b>Fecha Inicio:</b>
                                                        {$subject.initialDate|date_format:"%d-%m-%Y"}</h5>
                                                    <h5 class="card-title"><b>Fecha Fin:</b>
                                                        {$subject.finalDate|date_format:"%d-%m-%Y"}</h5>
                                                    <p class="card-text">
                                                        <b>Calificación:</b> <span
                                                            class="badge {if $subject.totalScore < $minCal} badge-danger {else} badge-success {/if} rounded-circle">
                                                            {$subject.totalScore}
                                                        </span><br />
                                                    </p>
                                                </div>
                                                <div class="col-md-8 text-center">
                                                    {if $subject.icon eq ''}
                                                        <picture>
                                                            <source srcset="{$WEB_ROOT}/images/logos/logo-humanismo.webp"
                                                                type="image/webp" class="img-fluid">
                                                            <img src="{$WEB_ROOT}/images/logos/logo-humanismo.png" alt="Logo Humanismo"
                                                                class="img-fluid"
                                                                style="width: 250px !important; height: auto !important; border-radius: 0 !important;">
                                                        </picture>
                                                    {else}
                                                        <img src="{$WEB_ROOT}/images/new/modulos/{$subject.icon}" alt="IAP Chiapas"
                                                            style="width: 300px !important; height: auto !important; border-radius: 0 !important;">
                                                    {/if}<br />
                                                    {* INGRESAR AL MODULO *}
                                                    {if $User.type == "student"}
                                                        {if  $timestamp < $subject.initialDateStamp}
                                                            <span class="badge badge-danger my-1 mx-1"><i class="fas fa-ban"></i> Módulo No
                                                                Iniciado</span>
                                                        {else}
                                                            {if $subject.finalDateStamp > 0 AND $timestamp > $subject.finalDateStamp}
                                                                <span class="badge badge-success my-1 mx-1"><i class="fas fa-check-circle"></i>
                                                                    Módulo Finalizado</span>
                                                            {elseif $subject.active == "no"}
                                                                <span class="badge badge-success my-1 mx-1"><i class="fas fa-check-circle"></i>
                                                                    Módulo Finalizado</span>
                                                            {elseif $subject.finalDateStamp <= 0 AND $initialDateStamp < $subject.daysToFinishStamp AND $timestamp > $subject.daysToFinishStamp}
                                                                <span class="badge badge-success my-1 mx-1"><i class="fas fa-check-circle"></i>
                                                                    Módulo Finalizado</span>
                                                            {else}
                                                                <a href="{$WEB_ROOT}/view-modules-student/id/{$subject.courseModuleId}"
                                                                    title="Ver Modulo de Curso" class="btn btn-outline-dark btn-sm my-1 mx-1">
                                                                    <i class="fas fa-sign-in-alt"></i> Ingresar al Módulo
                                                                </a>
                                                            {/if}
                                                        {/if}
                                                    {/if}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {/if}
                            {foreachelse}
                            {/foreach}
                        </div>
                    </div>
                </div>
            {/for}
        </div>
    </div>
</div>