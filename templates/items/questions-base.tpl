{foreach from=$tests item=subject}
    <tr class="text-center">
        <td class="id">{$subject.testId}</td>
        <td class="break-line">{$subject.question}</td>
        <td>{$subject.opcionAShort}</td>
        <td>{$subject.opcionBShort}</td>
        <td>{$subject.opcionCShort}</td>
        <td>{$subject.opcionDShort}</td>
        <td>{$subject.opcionEShort}</td>
        <td>{$subject.answer}</td>
        <td>
            <a href="{$WEB_ROOT}/graybox.php?page=edit-question&id={$subject.testId}"
                data-target="#ajax" data-toggle="modal">
                <i class="fas fa-edit fa-lg spanEdit" id="d-{$subject.subjectId}" name="d-{$subject.name}"
                    title="Editar"></i>
            </a>
        </td>
    </tr>
{foreachelse}
    <tr>
        <td colspan="9" class="text-center">No se encontró ningún registro.</td>
    </tr>
{/foreach}