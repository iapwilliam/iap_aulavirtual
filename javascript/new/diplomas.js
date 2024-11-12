$("#datatable").DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax: {
        url: $("#datatable").data('url'),
        dataType: "json",
        type: "POST",
        data: {
            _token: $("meta[name='csrf-token'] ").attr('content')
        }
    },
    language: {
        url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    columns: [
        { data: "id" },
        { data: "nombre" },
        { data: "imagen_portada" },
        { data: "imagen_contraportada" },
        { data: "cursos" },
        { data: "acciones" }
    ],
}); 