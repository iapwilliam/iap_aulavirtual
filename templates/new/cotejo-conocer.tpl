<div class="card p-4">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span>
            Información adicional
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>IAP Chiapas
                    <i class="mdi mdi-checkbox-marked-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <section>
        <div class="row">
            <div class="col-md-12 mx-auto">
                <table class="table" id="datatable" data-url="{$WEB_ROOT}/ajax/new/course.php">
                    <thead>
                        <tr>
                            <th>Control</th>
                            <th>Alumno</th>
                            <th>Pago</th>
                            <th>Evaluación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<script>
    $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: $("#datatable").data('url'),
            dataType: "json",
            type: "POST",
            data: {
                _token: $("meta[name='csrf-token'] ").attr('content'),
                option: 'dt_cotejo_conocer',
                curso: {$curso}
            }
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        columns: [
            { data: "control" },
            { data: "alumno" },
            { data: "pago" },
            { data: "evaluacion" },
            { data: "acciones" }
        ],
    });
</script>