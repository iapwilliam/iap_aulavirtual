<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-user-edit"></i> Editar Información
    </div>
    <div class="card-body">
        <div id="tblContent">
            {if $form == 0}
                {include file="{$DOC_ROOT}/templates/boxes/new/select-register.tpl"}
            {else}
                {include file="{$DOC_ROOT}/templates/forms/new/update-student.tpl"}
            {/if}
        </div>
    </div>
</div>