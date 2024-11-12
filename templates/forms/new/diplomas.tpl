<div class="card">
    <form class="form card-body" id="form_new_diploma" action="{$WEB_ROOT}/ajax/new/course.php">
        <h3>Creación de diploma</h3>
        <input type='hidden' name="option" value="newDiplomaMultiple">
        <div class="form-group">
            <label>Nombre del diploma</label>
            <input type="text" name="nombre" class="form-control">
        </div>
        <div class="form-group">
            <label>Imagen de adelante</label>
            <input type="file" name="imagen_portada" class="form-control">
        </div>
        <div class="form-group">
            <label>Imagen trasera</label>
            <input type="file" name="imagen_contraportada" class="form-control">
        </div>
        <div class="form-group">
            <label>Curso</label>
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