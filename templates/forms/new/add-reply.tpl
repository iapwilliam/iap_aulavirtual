{if $permiso}
<div class="col-md-12 mt-4">
    <form id="addNoticia" class="form" name="addNoticia" method="post" action="{$WEB_ROOT}/add-reply/id/{$moduleId}/topicsubId/{$topicsubId}" enctype="multipart/form-data">
        <input type="hidden" id="type" name="type" value="saveAddMajor" />
        <input type="hidden" id="topicsubId" name="topicsubId" value="{$topicsubId}" />
        <input type="hidden" id="moduleId" name="moduleId" value="{$moduleId}" />
        <input type="hidden" id="positionId" name="positionId" value="{$positionId}" />
        <input type="hidden" id="userId" name="userId" value="{$userId}" />
        <div class="row">
            <div class="form-group col-md-12">
                <label for="reply">Aportación:</label>
                <textarea name="reply" id="reply" class="form-control"></textarea>
                <span class="invalid-feedback"></span>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label for="path">Subir Archivo:</label>
                <input type="file" name="path" id="path" class="form-control" />
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="submit" class="btn btn-primary" id="addMajor" name="addMajor" value="Enviar Aportación"/>
            </div>
        </div>
    </form>
</div>    
{/if}
