<h4 class="text-center">Por favor, seleccione la curricula de la que desea modificar sus datos</h4>
<div class="text-center">
    {foreach from=$cursos item=item}
        <a href="{$WEB_ROOT}/alumn-services/curso/{$item.courseId}" class="btn btn-success">{$item.subject_name} -
            {$item.group}</a>
    {/foreach}
</div>