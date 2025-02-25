{foreach from=$announcements item=item}
	<div class="card border border-dark rounded mb-4">
		<div class="card-header bg-dark text-white">
			<b>{$item.title}</b> - {$item.date|date_format:"%d/%m/%Y - %H:%M"}
			{if $User.positionId == "1" && $vp==1}
				| &raquo; <a href="{$WEB_ROOT}/homepage/id/{$item.announcementId}"
					onclick="return confirm('&iquest;Desea eliminar la noticia?')"> Eliminar Noticia </a>
			{/if}
			{if $UserType ne 'student'}
				<a href="{$WEB_ROOT}/graybox.php?page=add-noticia&cId={$item.announcementId}" data-target="#ajax"
					data-toggle="modal" title="INICIAR PROCESO" class="float-right">
					<i class="fas fa-edit fa-lg text-white"></i>
				</a>
			{/if}
		</div>
		<div class="card-body iframe">{$item.description}</div>
	</div>
{/foreach}