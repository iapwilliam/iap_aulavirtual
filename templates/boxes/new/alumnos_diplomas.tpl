<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-file-contract"></i>Alumnos
    </div>
    <div class="card-body"> 
        <table class="table" id="datatable_alumnos" data-url="{$WEB_ROOT}/ajax/new/course.php">
            <thead>
                <tr>
                    <th>Alumno ID</th>
                    <th>Número de control</th>
                    <th>Contraseña</th>
                    <th>Nombre</th>
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

<script> 
    $("#datatable_alumnos").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: $("#datatable_alumnos").data('url'),
            dataType: "json",
            type: "POST",
            data: {
                option: 'dt_alumnos_diplomas',
                diploma: {$diploma}
            }
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        columns: [
            { data: "id" },
            { data: "controlNumber" },
            { data: "password" },
            { data: "nombre" },
            { data: "acciones" }
        ],
    });
</script>