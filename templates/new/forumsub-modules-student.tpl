<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-bullhorn"></i> Foro {$asunto}
        <div class="col-md-12 text-right">
            {if $asunto == "Presentacion Personal"}
                <a href="{$WEB_ROOT}/graybox.php?page=add-topic&id={$topicId}&cId={$id}" data-target="#ajax"
                    data-toggle="modal" class="btn btn-outline-light btn-sm">
                    <span class="btnAdd" id="btnAddSubject"><i class="fas fa-plus-circle"></i> Agregar</span>
                </a>
            {/if}
            {if $User.perfil eq "Alumno"}
                <a href="{$WEB_ROOT}/forum-modules-student/id/{$id}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            {else}
                <a href="{$WEB_ROOT}/edit-modules-course/id/{$id}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-arrow-circle-left"></i> Regresar
                </a>
            {/if}
        </div>
    </div>
    <div class="card-body">
        <div id="tblContent" class="table-responsive">
            {include file="boxes/status_no_ajax.tpl"}
            <div id="tblContent" class="mb-3">{include file="lists/topicsub.tpl"}</div>
            {if $coursesCount}
                <div id="pagination" class="lnkPages">
                    {include file="footer-pages-links.tpl"}
                </div>
            {/if}
        </div>
    </div>
</div>
<input type="hidden" id="viewPage" name="viewPage" value="{$arrPage.currentPage}" />