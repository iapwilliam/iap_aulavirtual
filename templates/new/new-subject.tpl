<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-bookmark"></i> Agregar Instancias de Curricula
    </div>
    <div class="card-body">
        <form id="form_subject" class="form" method="POST" action="{$WEB_ROOT}/ajax/new/subject.php">
            <input type="hidden" name="opcion" value="addSubject">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="tipo">Tipo:</label>
                    <select name="tipo" id="tipo" class="form-control">
                        {foreach from=$major item=item}
                            <option value="{$item.majorId}">{$item.name}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" value="" />
                </div>
                <div class="form-group col-md-4">
                    <label for="code">Clave:</label>
                    <input type="text" name="code" id="code" value="" class="form-control" />
                </div>
                <div class="form-group col-md-4">
                    <label for="totalPeriods">Total de fases:</label>
                    <input type="text" name="totalPeriods" id="totalPeriods" value="" class="form-control" />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="welcomeText">Texto de Bienvenida:</label>
                    <textarea id="welcomeText" name="welcomeText" rows="15" cols="80" style=""
                        class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="introduction">Introduccion:</label>
                    <textarea id="introduction" name="introduction" rows="15" cols="80" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="intentions">Intenciones:</label>
                    <textarea id="intentions" name="intentions" rows="15" cols="80" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="objectives">Objetivos:</label>
                    <textarea id="objectives" name="objectives" rows="15" cols="80" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="methodology">Metodologia:</label>
                    <textarea id="methodology" name="methodology" rows="15" cols="80" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="politics">Politicas:</label>
                    <textarea id="politics" name="politics" rows="15" cols="80" class="form-control"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12 text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success submitForm">Guardar</button>
                </div>
            </div>

        </form>

        <script type="text/javascript">
            $(function() {
                $('textarea').each(function() {
                    new Jodit(this, {
                        language: "es",
                        toolbarButtonSize: "small",
                        autofocus: true,
                        toolbarAdaptive: false
                    });
                });

                flatpickr('.i-calendar', {
                    dateFormat: "d-m-Y"
                });
            });
        </script>

    </div>
</div>