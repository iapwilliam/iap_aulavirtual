<div class="portlet box red">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-bullhorm"></i><b>Solicitudes</b> {$myModule.name|truncate:65:"..."} &raquo;
        </div>
        <div class="actions">

        </div>
    </div>
    <div class="portlet-body">
	{if $msj eq 'si'}
	<div class="alert alert-info alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <strong></strong>La Solicitud ha sido enviada correctamente
	</div>
	{/if}
		<!--<div style='float:right !important'>
			<a class="btn blue"  href="{$WEB_ROOT}/graybox.php?page=solicitud-constancia&id=con" data-target="#ajax" data-toggle="modal" data-width="1000px">
                 Solicitar
			</a>
		</div>-->
        {include file="boxes/status_no_ajax.tpl"}

        {include file="{$DOC_ROOT}/templates/lists/new/solicitud.tpl"}
    </div>
</div>