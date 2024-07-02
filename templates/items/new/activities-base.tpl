{foreach from=$actividades item=subject}
    <tr>
        <td class="id text-center">{$subject.activityId}</td>
        <td class="text-center">{$subject.activityType}</td>
        <td class="text-center">{$subject.initialDate|date_format:"%d-%m-%Y"} {$subject.horaInicial}</td>
        <td class="text-center">{$subject.finalDate|date_format:"%d-%m-%Y %H:%M:%S"}</td>
        <td class="text-center">{$subject.modality}</td>
        <td class="text-center">
            {if $subject.requiredActivity != 0}
                Id: {$subject.requiredActivity} Resumen: {$subject.requerida.resumen}
            {else}
                N/A
            {/if}
        </td>
        <td class="text-center">{$subject.score}%</td>
        <td class="text-center">{$subject.resumen}</td>
        <td class="text-center">
            {if $subject.activityType == "Examen"}
                {if $majorModality == "Online"}
                    <a href="{$WEB_ROOT}/configuracion-examen/id/{$subject.activityId}" class="btn btn-info btn-sm">Configurar</a>
                {else}
                    <a href="{$WEB_ROOT}/configuracion-examen/id/{$subject.activityId}" class="btn btn-info btn-sm">Configurar</a>
                {/if}
            {else}
                N/A
            {/if}
        </td>
        <td class="text-center">
            {if $configMateria ne 'si'}
                <i data-id="{$subject.activityId}" id="d-{$subject.activityId}" name="d-{$subject.name}"
                    class="fas fa-times-circle fa-2x text-danger pointer spanDelete" data-toggle="tooltip" data-placement="top"
                    title="Eliminar"></i>
                <a href="{$WEB_ROOT}/graybox.php?page=edit-activity&id={$subject.activityId}&auxTpl=admin&cId={$myModule.courseModuleId}"
                    data-target="#ajax" data-toggle="modal">
                    <i id="d-{$subject.subjectId}" name="d-{$subject.name}"
                        class="fas fa-pen-square fa-2x text-success pointer spanEdit" data-toggle="tooltip" data-placement="top"
                        title="Editar"></i>
                </a>
            {else}
                <a href="javascript:void(0)" onClick="deleteAct('{$subject.activityConfigId}')">
                    <i class="fas fa-times-circle fa-2x text-danger pointer" data-toggle="tooltip" data-placement="top"
                        title="Eliminar"></i>
                </a>
                <a href="{$WEB_ROOT}/graybox.php?page=add-activity-c&id={$subject.activityConfigId}&auxTpl=admin&cId={$courseModuleId}"
                    data-target="#ajax" data-toggle="modal">
                    <i id="d-{$subject.subjectId}" name="d-{$subject.name}"
                        class="fas fa-pen-square fa-2x text-success pointer spanEdit" data-toggle="tooltip" data-placement="top"
                        title="Editar"></i>
                </a>
            {/if} 
            {if $configMateria ne 'si'}
                <a href="{$WEB_ROOT}/score-activity-new&id={$subject.activityId}&auxTpl=admin&cId={$myModule.courseModuleId}">
                    <i id="d-{$subject.subjectId}" name="d-{$subject.name}" title="Calificar"
                        class="fas fa-clipboard-check fa-2x text-info pointer spanEdit" data-toggle="tooltip"
                        data-placement="top"></i>
                </a>
            {/if} 
            {if $subject.activityType == "Foro"}
                <a href="{$WEB_ROOT}/graybox.php?page=foro-estadisticas&actividad={$subject.activityId}&grupo={$myModule.courseModuleId}"
                    data-target="#ajax" data-toggle="modal">
                    <i id="d-{$subject.subjectId}" name="d-{$subject.name}" title="Estadísticas"
                        class="fas fa-chart-bar fa-2x text-info pointer spanEdit" data-toggle="tooltip"
                        data-placement="top"></i>
                </a>
            {/if}
        </td>
    </tr>
{foreachelse}
    <tr>
        <td colspan="10" class="text-center">No se encontró ningún registro.</td>
    </tr>
{/foreach}