$(function(){
    $("#dataTable_length").css("display","none");
    cargarPasajerosCombo();
    cargarVuelosCombo();
    cargarReservaciones();
});

function cargarPasajerosCombo(){
    $.ajax({
            data:{
                accion:'SP'
            },
            url:"./ManagerBD/ManagerReservaciones.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#comboPasajeros").html(response);
            }
        });
}

function cargarVuelosCombo(){
    $.ajax({
            data:{
                accion:'SV'
            },
            url:"./ManagerBD/ManagerReservaciones.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#comboVuelos").html(response);
            }
        });
}

function cambioPasajero(){
    $.ajax({
        data:{
            accion:'SPI',
            id:$("#comboPasajeros").val()
        },
        url:"./ManagerBD/ManagerPasajeros.php",
        type:"post",
        success:function(response){
            var data = response.split(',');
            $("#nacionalidadReservacion").val(data[1]);
            $("#telefonoReservacion").val(data[5]); 
            $("#pasajeroReservacion").val(data[0]);
        }
    });
}

function cambioVuelo(){
    $.ajax({
        data:{
            accion:'SVI',
            id:$("#comboVuelos").val()
        },
        url:"./ManagerBD/ManagerVuelos.php",
        type:"post",
        success:function(response){
            var data = response.split(',');
            $("#destinoReservacion").val(data[0]);
            $("#costoReservacion").val(data[2]);
            $("#fechaSalidaReservacion").val(data[3]);
            $("#fechaLlegadaReservacion").val(data[4]);
            $("#aerolineaReservacion").val(data[2]); 
           
        }
    });
}

function cargarReservaciones(){
    $.ajax({
            data:{
                accion:'SR'
            },
            url:"./ManagerBD/ManagerReservaciones.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyReservaciones").html(response);
            }
        });
}

function guardarReservacion(){
    $.ajax({
            data:{
                accion:'GR',
                destinoReservacion:$("#destinoReservacion").val(), 
                pasajeroReservacion:$("#pasajeroReservacion").val(), 
                costoReservacion:$("#costoReservacion").val(),
                idReservacion:$("#idReservacion").val(),
                aerolineaReservacion:$("#aerolineaReservacion").val(),
                fechaSalidaReservacion:$("#fechaSalidaReservacion").val(),
                fechaLlegadaReservacion:$("#fechaLlegadaReservacion").val(),
                idPasajero:$("#comboPasajeros").val(),
                idVuelo:$("#comboVuelos").val()
                
            },
            url:"./ManagerBD/ManagerReservaciones.php",
            type:"post",
            success:function(response){
                cargarReservaciones();
                $( "#idClose" ).trigger( "click" );
            }
        });
}

function cargarReservacion($id){
    $.ajax({
        data:{
            accion:'SRI',
            id:$id
           },
        url:"./ManagerBD/ManagerReservaciones.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
            $('[name=comboPasajeros]').val( data[0] );
            $('[name=comboVuelos]').val( data[1] );
            cambioPasajero();
            cambioVuelo();
            $("#idReservacion").val(data[2]);
            $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}

function eliminarReservacion($id){
    $.ajax({
        data:{
            accion:'ER',
            id:$id
           },
        url:"./ManagerBD/ManagerReservaciones.php",
        type:"post",
        success:function(response){
            cargarReservaciones();
        }
    });
}