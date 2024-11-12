<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-file-contract"></i> Diplomas y/o Certificados
    </div>
    <div class="card-body">
        <form id="form-certificado" action="{$WEB_ROOT}/ajax/new/course.php" class="form text-right mb-3">
            <input type="hidden" name="option" value="add_diploma">
            <button class="btn btn-success" type="submit">Crear</button>
        </form>
        <table class="table" id="datatable" data-url="{$WEB_ROOT}/diplomas">
            <thead>
                <tr>
                    <th>Diploma ID</th> 
                    <th>Nombre</th>
                    <th>Imagen delante</th>
                    <th>Imagen atrás</th>
                    <th>Cursos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<style>
    .compact {
        max-width: 200px;
        white-space: normal !important;
    }
</style>