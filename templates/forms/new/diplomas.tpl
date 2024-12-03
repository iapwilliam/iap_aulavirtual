<div class="card">
    <form class="form card-body" id="form_new_diploma" action="{$WEB_ROOT}/ajax/new/course.php">
        <h3>Creación del documento digital</h3>
        <input type='hidden' name="option" value="newDiplomaMultiple">
        <div class="form-group">
            <label for="tipo">Tipo de documento</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="">--Tipo de documento--</option>
                <option value="1">Diploma</option>
                <option value="2">Constancia</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del documento</label>
            <input type="text" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="imagen_portada">Portada</label>
            <input type="file" name="imagen_portada" class="form-control">
        </div>
        <div class="form-group">
            <label for="imagen_contraportada">Contraportada</label>
            <input type="file" name="imagen_contraportada" class="form-control">
        </div>
        <div class="form-group">
            <label for="curso">Curso</label>
            <select class="form-control selectpicker" id="curso" name="curso[]" multiple data-live-search="true">
                {foreach from=$cursos item=curso}
                    <option value="{$curso.courseId}">{$curso.major_name} {$curso.subject_name}</option>
                {/foreach}
            </select>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-success btn-block" type="submit">Guardar</button>
        </div>
    </form>
</div>

<script>
    $('.selectpicker').selectpicker();
</script>