<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-bullhorn"></i> Foro {$asunto}
        <div class="col-md-12 text-right">
            <a href="{$WEB_ROOT}/edit-modules-course/id/{$id}" class="btn btn-outline-light btn-sm"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
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