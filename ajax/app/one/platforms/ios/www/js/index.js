/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
 

 
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
		iniciaMysql();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
		// alert("d")
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
		
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
	
	
	
};





var urlLoc = "localhost";

// var WEB_ROOT = "http://" + urlLoc + "/iap";
// var WEB_ROOT = "http://www.iapchiapasenlinea.mx/dev/iap";
var WEB_ROOT = "http://www.iapchiapasenlinea.mx/";


function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
	
function DoLogin()
{
// alert(WEB_ROOT)
    $.ajax({
        url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : $('#frmGral').serialize(),
        success: function(data)
        {
			console.log(data)
            var splitResponse = data.split("[#]");

            if($.trim(splitResponse[0]) == "ok")
            {
				document.cookie = "usuarioId="+splitResponse[1];
                $.mobile.changePage("#home");
				iniciaMysql()
            }
            else if($.trim(splitResponse[0]) == "fail")
            {
               alert('Tu usuario o contraseña son incorrectas. Favor de verificarlas.');
            }
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
}


function iniciaMysql()
{
	
	// alert(getCookie("usuarioId"))
	
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=inicio&usuarioId='+getCookie("usuarioId"),
        success: function(data)
        {
			
			
			console.log(data)
           var splitResponse = data.split("[#]");
		   $("#fotoheader").html(splitResponse[1])
           $("#dataAlumnos").html(splitResponse[2])
           $("#divActiva").html(splitResponse[3])
           $("#divInactiva").html(splitResponse[4])
           $("#divFinalizada").html(splitResponse[5])
           
            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
}


function viewModules(Id,estatus)
{

	$.mobile.changePage("#divModules");
	
	document.cookie = "courseId="+Id;
	 
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=viewModules&courseId='+Id+'&estatus='+estatus+'&usuarioId='+getCookie("usuarioId"),
        success: function(data)
        {
			
			console.log(data)
           var splitResponse = data.split("[#]");
           $("#divModule").html(splitResponse[1])
            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
	
}


function verDetalle(Id,estatus)
{

	
	
	document.cookie = "courseId="+Id;
	 
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=verDetalle&courseId='+Id+'&estatus='+estatus+'&usuarioId='+getCookie("usuarioId"),
        success: function(data)
        {
			console.log(data)
			var splitResponse = data.split("[#]");
			if(estatus=="Activo"){
				$.mobile.changePage("#divDetalle");
			   $("#divAnuncios").html(splitResponse[1])
			   $("#divInformacion").html(splitResponse[2])
			   $("#divActividad").html(splitResponse[3])
			   $("#divExamen").html(splitResponse[4])
			   $("#divRecursos").html(splitResponse[5])
			   $("#divForo").html(splitResponse[6])
			   $("#divDocente").html(splitResponse[7])
			}else{
				$.mobile.changePage("#divCal");
				$("#divActividades").html(splitResponse[1])
			    $("#divExamenes").html(splitResponse[2])
			}
			
            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
	
}	

function miCuenta()
{
	$.mobile.changePage("#cuenta");
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=miCuenta&usuarioId='+getCookie("usuarioId"),
        success: function(data)
        {
			console.log(data)
           var splitResponse = data.split("[#]");
           $(".fotoher").html(splitResponse[1])
           $("#divPersonal").html(splitResponse[2])
           $("#divDomicilio").html(splitResponse[3])
           $("#divLaborales").html(splitResponse[4])
           $("#divEstudios").html(splitResponse[5])
            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
}

function back(id)
{
	$.mobile.changePage("#"+id);
}


function openAnuncio(Id)
{
	$("#divanun_"+Id).toggle();
}



function detalleActividad(id)
{
	$.mobile.changePage("#divDetalleActividad");
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=detalleActividad&usuarioId='+getCookie("usuarioId")+'&actividadId='+id,
        success: function(data)
        {
			console.log(data)
           var splitResponse = data.split("[#]");
           $("#divDetalleP").html(splitResponse[1])

            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
}




function detalleRecurso(id)
{
	$.mobile.changePage("#divDetaRecurso");
	$.ajax({
		url : WEB_ROOT+'/ajax/app/querys.php',
        type: "POST",
        data : 'type=detalleRecurso&usuarioId='+getCookie("usuarioId")+'&actividadId='+id,
        success: function(data)
        {
			console.log(data)
           var splitResponse = data.split("[#]");
           $("#divDetalleR").html(splitResponse[1])

            
        },
        error: function ()
        {
            alert('Algo salio mal, compruebe su conexion a internet');
        }
    });
}


function openConfig()
{
	$.mobile.changePage("#divConfig");
}

function Close()
{
	$.mobile.changePage("#login");
	document.cookie = "courseId=''";
	document.cookie = "usuarioId=''";
	$("#passwd").val('');
}


function acercaDe()
{
	$.mobile.changePage("#divAcerca");
}
