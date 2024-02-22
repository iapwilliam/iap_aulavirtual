<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <form class="form" id="form_add_module" action="{$WEB_ROOT}/ajax/new/subject.php">
            <input type='hidden' name="opcion" value="addModule">
            <input type='hidden' name="subject" value="{$id}">
            <button type="submit" class="btn btn-info btn-sm float-right second-modal">
                <i class="fas fa-plus-circle"></i> Click para agregar módulos a Currícula
            </button>
        </form>
    </div>
    <div class="card-body">
        <div id="tblContent" class="table-responsive">
            {include file="{$DOC_ROOT}/templates/lists/new/modules.tpl"}
        </div>
    </div>
</div>