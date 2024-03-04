{foreach from=$forum item=topicsub}
    <tr class="text-center">
        <td class="id">{$topicsub.nombre|truncate:50:"..."}</td>
        <td>{$topicsub.topicsubDate}</td>
        <td id="etitl1">
            {if $topicsub.names}{$topicsub.names} {$topicsub.lastNamePaterno} {$topicsub.lastNameMaterno}{else}Profesor{/if}
        </td>
        <td id="etitl1">{$topicsub.answers}</td>
        <td>
            <a href="{$WEB_ROOT}/add-reply/id/{$id}/topicsubId/{$topicsub.topicsubId}">
                <i class="fas fa-sign-in-alt fa-2x text-dark"></i>
            </a>
        </td>
    </tr>
{foreachelse}
    <tr>
        <td colspan="5" class="text-center">No se encontró ningún registro.</td>
    </tr>
{/foreach}