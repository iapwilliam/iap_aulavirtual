<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>                 
        </span>
        {$myModule.majorName}: {$myModule.subjectName}
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
    <div class="col-md-2">
        {include file="new/student-menu.tpl"}
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 mb-3">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white mr-2">
                        <i class="mdi mdi-tag"></i>                 
                    </span>
                    <b>Actividades</b>
                </h3>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            Calificación acumulada:</b> {$totalScore}%
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {$totalScore}%" aria-valuenow="{$totalScore}" aria-valuemin="0" aria-valuemax="100">{$totalScore}%</div>
                        </div>
                        {if $exito eq "si"}
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>La actividad se subió correctamente al sistema de tareas.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        {else}
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{$exito}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        {/if}
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr class="text-center">
                                        <th class="font-weight-bold" width="5%">#</th>
                                        <th class="font-weight-bold" width="35%">Actividad</th>
                                        <th class="font-weight-bold" width="20%">Progreso</th>
                                        <th class="font-weight-bold" width="5%">Estatus de la Actividad</th>
                                        <th class="font-weight-bold" width="16%">Entregable</th>
                                        <th class="font-weight-bold" width="16%">Estatus del Entregable</th>
                                        <th width="19%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach from=$actividades item=item}
                                        <tr class="{if $timestamp > $item.initialDateTimestamp && $timestamp < $item.finalDateTimestamp} table-success {/if} {if $timestamp > $item.finalDateTimestamp} table-danger {/if} {if $timestamp < $item.initialDateTimestamp} table-danger {/if}">
                                            <td class="text-center">{$consecutive++}</td>
                                            <td>{include file="{$DOC_ROOT}/templates/lists/new/module-calendar-td.tpl"}</td>
                                            <td class="text-center">
                                            {if $item.activityScore != 0}
                                                <p><b>Valor de la Actividad:</b> {$item.activityScore}%</p>
                                                {if $item.ponderation}
                                                    <p>
                                                        <b>Calificación:</b> {$item.ponderation}<br />
                                                        <b>Porcentaje obtenido: </b>{$item.realScore}%
                                                    </p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {$item.ponderation}%" aria-valuenow="{$item.ponderation}" aria-valuemin="0" aria-valuemax="100">{$item.ponderation}%</div>
                                                    </div>
                                                {/if}
                                            {/if}
                                            </td>
                                            <td class="text-center">
                                                {if $timestamp > $item.initialDateTimestamp && $timestamp < $item.finalDateTimestamp}
                                                    <span class="badge badge-pill badge-success break-line">Esta actividad se encuentra disponible</span>
                                                {/if}
                                                {if $timestamp > $item.finalDateTimestamp}
                                                    <span class="badge badge-pill badge-danger break-line">El tiempo de esta actividad ha terminado</span>
                                                {/if}
                                                {if $timestamp < $item.initialDateTimestamp}
                                                    <span class="badge badge-pill badge-warning break-line">Esta actividad aun no ha iniciado</span>
                                                {/if}
                                            </td>
                                            <td class="text-center">
                                                {if $item.homework.path ne ''}
                                                    {if $item.homework.path ne ''}
                                                        <button class="btn btn-outline-info btn-xs" onclick="window.location.href='{$WEB_ROOT}/download.php?file=homework/{$item.homework.path}&mime={$item.homework.mime}'" class="bb">
                                                            <i class="far fa-file-alt"></i> Ver Tarea
                                                        </button>
                                                        {if $timestamp < $item.finalDateTimestamp}  
                                                            {if $item.homework.countUpdate ne 1}
                                                                {if $item.modality eq 'Individual'}
                                                                    <br><br>
                                                                    <button class="btn btn-outline-danger btn-xs" onclick="deleteActividad('{$item.activityId}')" class="bb">
                                                                        <i class="fas fa-trash-alt"></i> Eliminar
                                                                    </button>
                                                                {/if}
                                                            {/if}
                                                        {/if}
                                                    {/if}
                                                {/if}
                                            </td>
                                            <td class="text-center">
                                                {if $item.homework.path ne ''}
                                                    <span class="badge badge-pill badge-success">Tarea entregada</span>
                                                {/if}
                                            </td>
                                            <td class="text-center">
                                                <a href="{$WEB_ROOT}/graybox.php?page=view-description-activity&id={$item.activityId};" class="btn btn-info btn-xs" data-target="#ajax" data-toggle="modal" >
                                                    <i class="fas fa-info-circle"></i> Descripción
                                                </a>
                                                {* RETROALIMENTACION *}
                                                {if $item.retro}
                                                    <br>
                                                    <a href="javascript:void(0)" onClick="verRetro('{$item.activityId}')" class="btn btn-info btn-xs my-2" title="Ver Retroalimentación">
                                                        <i class="far fa-comment"></i> Ver Retroalimentación
                                                    </a>
                                                    <div style="display:none;" id="divRetro_{$item.activityId}">{$item.retro}</div>
                                                {/if}
                                                {* ARCHIVO ADJUNTO *}
                                                {if $item.retroFile ne ""}
                                                    <br />
                                                    <b class="break-line">Archivo Adjunto Disponible:</b><br><br>
                                                    <a href='{$WEB_ROOT}/file_retro/{$item.retroFile}' target="_blank" class="bb" style="background: #73b760; color:white">Descargar</a>
                                                {/if}
                                            </td>
                                        </tr>
                                        {* {include file="{$DOC_ROOT}/templates/lists/new/module-calendar.tpl"} *}
                                    {/foreach}
                                    {foreach from=$examenes item=item}
                                        <tr class="{if $timestamp > $item.initialDateTimestamp && $timestamp < $item.finalDateTimestamp} table-success {/if} {if $timestamp > $item.finalDateTimestamp} table-danger {/if} {if $timestamp < $item.initialDateTimestamp} table-danger {/if}">
                                            <td class="text-center">{$consecutive++}</td>
                                            <td>{include file="{$DOC_ROOT}/templates/lists/new/module-calendar-td.tpl"}</td>
                                            <td>
                                                {if $item.ponderation}
                                                    <p>
                                                        <b>Calificación:</b> {$item.ponderation}<br />
                                                        <b>Porcentaje obtenido: </b>{$item.realScore}%
                                                    </p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {$item.ponderation}%" aria-valuenow="{$item.ponderation}" aria-valuemin="0" aria-valuemax="100">{$item.ponderation}%</div>
                                                    </div>
                                                {/if}
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-center">
                                                <a href="{$WEB_ROOT}/graybox.php?page=view-description-activity&id={$item.activityId};" class="btn btn-info btn-xs" data-target="#ajax" data-toggle="modal" >
                                                    <i class="fas fa-info-circle"></i> Descripción
                                                </a>
                                            </td>
                                        </tr>
                                        {* {include file="{$DOC_ROOT}/templates/lists/new/module-calendar.tpl"} *}
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>