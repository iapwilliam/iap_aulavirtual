<p class="font-weight-bold">{$item.resumen|capitalize}</p>
<p><small>
        <b>Fecha Inicial:</b> <br>{$item.initialDate|date_format:"%d-%m-%Y"} {$item.horaInicial}<br />
        <b>Fecha Final: </b> <br>{$item.finalDate|date_format:"%d-%m-%Y %H:%M:%S"}<br />
        <b>Modalidad: </b> <br>{$item.modality}
    </small></p>
{if $item.requerida.activityId}
    <p><small>
            {if $item.activityType == "Tarea"}
                <b>Tarea Requerida:</b> <br>Para realizar esta Actividad necesitas terminar la Actividad {$item.numreq}
            {/if}
            {if $item.activityType == "Examen"}
                <b>Tarea Requerida:</b> <br>Para realizar este Examen necesitas terminar la Actividad {$item.numreq}
            {/if}
        </small></p>
{/if}
{if $timestamp > $item.initialDateTimestamp && $timestamp < $item.finalDateTimestamp && $item.available}
    {if $item.activityType == "Lectura"}
        Ninguno.
    {/if}
    {if $item.activityType == "Tarea"}
        {if $vistaPrevia==0}
            {if $item.homework.path eq ''}
                <a href="{$WEB_ROOT}/graybox.php?page=upload-homework&id={$item.activityId}" title="Subir Tarea" data-target="#ajax"
                    data-toggle="modal" class="btn btn-xs btn-primary">
                    <i class="fas fa-file-upload"></i> Subir Actividad al Sistema de Tareas
                </a>
            {/if}
        {else}
            Subir Tarea al Sistema de Tareas.
        {/if}
    {/if}
    {if $item.activityType == "Examen"}
        {if $vistaPrevia==0}
            {if $item.acceso}
                <a id="presentarExamen" style="display: none" class=" btn btn-outline-warning sbold"
                    href="{$WEB_ROOT}/graybox.php?page=make-test&id={$item.activityId}" data-target="#ajax" data-toggle="modal">
                    <i class="fas fa-spell-check"></i> Presentar examen
                </a>
                <a class="pointer btn btn-outline-info btn-xs mb-3" onclick="DoTest({$item.activityId})">
                    <i class="fas fa-spell-check"></i> Presentar Examen.
                </a>
            {else}
                <a href="{$WEB_ROOT}/examen-respuestas/id/{$item.activityId}/module/{$item.courseModuleId}"
                    class="pointer btn btn-outline-info btn-xs mb-3">Ver respuestas</a>
            {/if}
        {else}
            Presentar Examen.
        {/if}
    {/if}
    {if $item.activityType == "Foro"}
        Participación en foro.
    {/if}
    {if $item.activityType == "Otro"}
        Ninguno.
    {/if}
{/if}