<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-project-diagram"></i> Nuevo módulo para {$subject.name} | <a
            href="{$WEB_ROOT}/index_new.php?page=subject" class="btn btn-info btn-sm float-right"><i
                class="fas fa-arrow-left"></i> Regresar</a>
    </div>
    <div class="card-body" style="max-height: 700px; overflow: scroll;">
        <form class="form" id="addSubjectForm" name="addSubjectForm" method="post"
            action="{$WEB_ROOT}/new-module/id/{$id}">
            <input type="hidden" name="subjectId" id="subjectId" value="{$id}" />
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" />
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group col-md-4">
                    <label for="frmClave">Clave:</label>
                    <input type="text" name="frmClave" id="frmClave" class="form-control" />
                </div>
                <div class="form-group col-md-2">
                    <label for="semesterId">Cuatrimestre/Semestre:</label>
                    <input type="number" name="semesterId" id="semesterId" class="form-control" value="1"
                        maxlength="2" />
                </div>
                <div class="form-group col-md-2">
                    <label for="creditos">Créditos</label>
                    <input type="number" name="creditos" id="creditos" class="form-control" value="1" maxlength="2" />
                </div>
                <div class="col-md-2 form-group">
                    <label for="tipo">¿Es parte de la currícula?</label>
                    <select class="form-control" name="tipo" id="tipo">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="welcomeText">Texto de Bienvenida:</label>
                    <textarea id="welcomeText" name="welcomeText" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="introduction">Introducción:</label>
                    <textarea id="introduction" name="introduction" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="intentions">Intenciones:</label>
                    <textarea id="intentions" name="intentions" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="objectives">Objetivos:</label>
                    <textarea id="objectives" name="objectives" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="themes">Temario:</label>
                    <textarea id="themes" name="themes" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="scheme">Esquema:</label>
                    <textarea id="scheme" name="scheme" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="methodology">Metodología:</label>
                    <textarea id="methodology" name="methodology" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="politics">Políticas:</label>
                    <textarea id="politics" name="politics" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="evaluation">Evaluación:</label>
                    <textarea id="evaluation" name="evaluation" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="bibliography">Bibliografía:</label>
                    <textarea id="bibliography" name="bibliography" rows="15" cols="80"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" onclick="btnClose()">Cancelar</button>
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
                    console.log("Activado");
                });
            });
        </script>
    </div>
</div>