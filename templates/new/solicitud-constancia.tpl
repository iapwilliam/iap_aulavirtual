<div class="portlet box red">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-bullhorn"></i>{if $id eq 'baja'} Adjuntar solicitud{else}Solicitar Constancia {/if}
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body">
         {include file="{$DOC_ROOT}/templates/forms/new/solicitud-constancia.tpl"}
    </div>
</div>