{foreach from=$personals item=item key=key}
    <tr>
        <td class="id text-center">{$item.personalId}</td>
        <td>
            {if $item.foto ne ''}
                <a data-fancybox="p{$item.personalId}" href="{$WEB_ROOT}/{$item.foto}">
                    <img src="{$WEB_ROOT}/{$item.foto}" class="img-fluid" />
                </a>
            {/if}
        </td>
        <td class="break-line">{$item.lastname_paterno} {$item.lastname_materno} {$item.name}</td>
        <td class="text-center">{$item.position}</td>
        <td class="text-center">
            <form name="{$item.personalId}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="personalId" id="personalId" value="{$item.personalId}" />
                <input type="file" name="foto" id="foto" class="form-control mt-3" /><br>
                <input type="submit" value="Cambiar Foto" class="btn btn-success btn-sm mt-2" />
            </form>
        </td>
        <td class="break-line">{$item.wrappedDescription}</td>
        <td class="text-center">
            <form class="form d-inline" id="form_personal_delete{$item.personalId}"
                action="{$WEB_ROOT}/ajax/new/personal.php">
                <input type="hidden" name="option" value="deletePersonal">
                <input type="hidden" name="personal" value="{$item.personalId}">
                <button class="btn btn-danger btn-sm" type="submit">
                    Eliminar
                </button>
            </form>
            <form class="form d-inline" id="form_personal_edit{$item.personalId}"
                action="{$WEB_ROOT}/ajax/new/personal.php">
                <input type="hidden" name="option" value="editPersonal">
                <input type="hidden" name="personal" value="{$item.personalId}">
                <button class="btn btn-success btn-sm" type="submit">
                    Editar
                </button>
            </form>
            {if $item.firmaConstancia eq 'si'}
                {*<img src="images/pointer.png?sd"   title="FIRMA CONSTANCIAS" />*}
                <i class="fas fa-file-signature text-info fa-2x" data-toggle="tooltip" data-placement="top"
                    title="Firma Constancias"></i>
            {/if}
        </td>
    </tr>
{foreachelse}
    <tr>
        <td colspan="5" class="text-center">No se encontró ningún registro.</td>
    </tr>
{/foreach}