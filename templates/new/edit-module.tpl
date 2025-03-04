<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-edit"></i> Editar información del módulo {$subject.name}
        <a href="{$WEB_ROOT}/edit-modules-course/id/{$moduleId}" class="btn btn-info btn-sm float-right">
            Regresar
        </a>
    </div>

    <div class="card-body">
        <div class="card mb-4">
            <div class="card-body">
                <form class="form" id="addSubjectForm" method="post" action="{$WEB_ROOT}/edit-module">
                    <input type="hidden" name="subjectModule" value="{$subjectModuleId}">
                    <input type="hidden" name="module" value="{$moduleId}">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" id="name" class="form-control" value="{$module.name}" />
                            <span class="invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="code">Clave:</label>
                            <input type="text" name="code" id="code" class="form-control" value="{$module.clave}" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="semesterId">Fase:</label>
                            <input type="number" name="semesterId" id="semesterId" class="form-control"
                                value="{$module.semesterId}" maxlength="2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="welcomeText">Texto de Bienvenida:</label>
                            <textarea id="welcomeText" name="welcomeText" rows="15"
                                cols="80">{$module.welcomeText}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="introduction">Introducción:</label>
                            <textarea id="introduction" name="introduction" rows="15"
                                cols="80">{$module.introduction}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="intentions">Intenciones:</label>
                            <textarea id="intentions" name="intentions" rows="15"
                                cols="80">{$module.introduction}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="objectives">Objetivos:</label>
                            <textarea id="objectives" name="objectives" rows="15"
                                cols="80">{$module.objectives}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="themes">Temario:</label>
                            <textarea id="themes" name="themes" rows="15" cols="80">{$module.themes}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="scheme">Esquema:</label>
                            <textarea id="scheme" name="scheme" rows="15" cols="80">{$module.scheme}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="methodology">Metodología:</label>
                            <textarea id="methodology" name="methodology" rows="15"
                                cols="80">{$module.methodology}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="politics">Políticas:</label>
                            <textarea id="politics" name="politics" rows="15" cols="80">{$module.politics}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="evaluation">Evaluación:</label>
                            <textarea id="evaluation" name="evaluation" rows="15"
                                cols="80">{$module.evaluation}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="bibliography">Bibliografía:</label>
                            <textarea id="bibliography" name="bibliography" rows="15"
                                cols="80">{$module.bibliography}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <a href="{$WEB_ROOT}/edit-modules-course/id/{$moduleId}" class="btn btn-danger">Cancelar</a>
                        </div>
                    </div>
                </form>
                <script type="text/javascript">
                    $(function() {
                        $('textarea').each(function() {
                            new Jodit(this, {
                                language: "es",
                                toolbarButtonSize: "small",
                                autofocus: false,
                                toolbarAdaptive: false
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>