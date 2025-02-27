<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
            {$smarty.now|date_format:"%Y"} &copy; Instituto de Administraci&oacute;n P&uacute;blica del Estado de
            Chiapas, A.C.
        </span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Departamento de Desarrollo de
            Sistemas - Dirección de Innovación Tecnológica</span>
    </div>
</footer>

<div class="modal" id="ajax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="btn-close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando...
            </div>
        </div>
    </div>
</div>

<div id="fview" style="display:none;">
    <input type="hidden" id="inputs_changed" value="0" />
    <div id="fviewload" style="display:block" class="text-center">
        <i class="fas fa-spinner fa-pulse fa-lg"></i> Cargando...
    </div>
    <div id="fviewcontent" style="display:none"></div>
    <div id="modal">
        <div id="submodal"></div>
    </div>
</div>
<div style="position:relative" id="divStatus"></div>