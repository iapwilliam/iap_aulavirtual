<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-clipboard-check"></i> Calificar Actividad
        <a href="{$WEB_ROOT}/edit-modules-course/id/{$actividad.courseModuleId}" class="btn btn-info float-right" id="btnAddMajor">
            <i class="fas fa-arrow-left"></i> Regresar al Módulo
        </a>
    </div>
    <div class="card-body">
        <div id="tblContent" class="table-responsive">
            {if $actividad.modality == "Individual"}
                {include file="{$DOC_ROOT}/templates/lists/score.tpl"}
            {else}
                {include file="{$DOC_ROOT}/templates/lists/score-team.tpl"}
            {/if}
        </div>
    </div>
</div>