$(document).ready(function () {
    $("#estadot").change(function () { ciudad_dependenciat(); });
});

function ciudad_dependenciat() {
    var estadoId = $("#estadot").val();
    $.ajax({
        url: WEB_ROOT + '/ajax/new/dependencia-ciudadest.php',
        type: "POST",
        data: { type: "loadCities", estadoId: estadoId },
        success: function (data) {
            var splitResponse = data.split("[#]");
            $('#Citypositiont').html(splitResponse[0]);
        },
        error: function () {
            alert('Algo salio mal, compruebe su conexión a internet');
        }
    });
}