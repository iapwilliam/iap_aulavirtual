$(document).ready(function(){

    $('#btnAddStudent').click(function() {
        AddStudentRegister();
    });

    $("#pais").change(function(){ estado_dependencia();});
    $("#estado").change(function(){ ciudad_dependencia();});
    $("#paist").change(function(){ estado_dependenciat();});
    $("#estadot").change(function(){ ciudad_dependenciat();});
});


function LoadCities()
{
    var idState = $("stateId").value;



}
//combo lugar de trabajo
function estado_dependenciat()
{
    var paisId = $("#paist").val();
    $.ajax({
        url : WEB_ROOT+'/ajax/new/dependencia-estadot.php',
        type: "POST",
        data : {type: "loadCities",  paisId: paisId},
        success: function(data)
        {
            var splitResponse = data.split("[#]");
            $('#Statepositiont').html(splitResponse[0]);
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexión a internet');
        }
    });
}

function ciudad_dependenciat()
{
    var estadoId = $("#estadot").val();
    $.ajax({
        url : WEB_ROOT+'/ajax/new/dependencia-ciudadest.php',
        type: "POST",
        data : {type: "loadCities",  estadoId: estadoId},
        success: function(data)
        {
            var splitResponse = data.split("[#]");
            $('#Citypositiont').html(splitResponse[0]);
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexión a internet');
        }
    });
}







////////// combox de usurio
function estado_dependencia()
{
    var paisId = $("#pais").val();
    $.ajax({
        url : WEB_ROOT+'/ajax/new/dependencia-estado.php',
        type: "POST",
        data : {type: "loadCities",  paisId: paisId},
        success: function(data)
        {
            var splitResponse = data.split("[#]");
            $('#Stateposition').html(splitResponse[0]);
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexión a internet');
        }
    });
}

function ciudad_dependencia()
{
    var estadoId = $("#estado").val();
    $.ajax({
        url : WEB_ROOT+'/ajax/new/dependencia-ciudades.php',
        type: "POST",
        data : {type: "loadCities",  estadoId: estadoId},
        success: function(data)
        {
            var splitResponse = data.split("[#]");
            $('#Cityposition').html(splitResponse[0]);
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexión a internet');
        }
    });
}


function AddStudentRegister()
{
    //alert("hola");
    $.ajax({
        url : WEB_ROOT+'/ajax/student.php',
        type: "POST",
        data :  $('#addStudentForm').serialize(),
		beforeSend: function(){		
			$("#addStudent").hide();
			$("#loader").html(LOADER3);
		},
        success: function(data)
        {
			$("#loader").html('');
			 var splitResponse = data.split("[#]");
			if($.trim(splitResponse[0]) == "ok"){
				ShowStatus($(splitResponse[1]));
				CloseFview();
                $('#tblContent').html(splitResponse[2]);
				setTimeout("recargarPage()",5000);
			}else{
				$("#addStudent").show();
				ShowStatusPopUp($(splitResponse[1]));
			}	
			// $("#loader").html('');
            // var splitResponse = data.split("[#]");
            // if(splitResponse[0] == "fail")
            // {
                // ShowStatusPopUp($(splitResponse[1]));
            // }
            // else
            // {
                // ShowStatus($(splitResponse[1]));
				// CloseFview();
                // $('#tblContent').html(splitResponse[2]);
				// setTimeout("recargarPage()",5000);

				
            // }
        },
        // error: function ()
        // {
            // alert('En breve recibirás un correo con la confirmación de tu registro, favor de verificar en tu bandeja de correo no deseado');
        // }
    });


}

function recargarPage()
{
	WEB_ROOTDoc = WEB_ROOT+'/login';
	$(location).attr('href',WEB_ROOTDoc);
}




