$(function(){
    $("#dataTable_length").css("display","none");
    cargarPasajeros();
});

function cargarPasajeros(){
    $.ajax({
            data:{
                accion:'SP'
            },
            url:"./ManagerBD/ManagerPasajeros.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyPasajeros").html(response);
            }
        });
}

function guardarPasajero(){
    $.ajax({
            data:{
                accion:'GP',
                nombrePasajero:$("#nombrePasajero").val(), 
                nacionalidadPasajero:$("#nacionalidadPasajero").val(), 
                generoPasajero:$("#generoPasajero").val(),
                fechaPasajero:$("#fechaPasajero").val(),
                telefonoPasajero:$("#telefonoPasajero").val(),
                direccionPasajero:$("#direccionPasajero").val(),
                idPasajero:$("#idPasajero").val()
                
            },
            url:"./ManagerBD/ManagerPasajeros.php",
            type:"post",
            success:function(response){
                cargarPasajeros();
            }
        });
}

function cargarPasajero($id){
    $.ajax({
        data:{
            accion:'SPI',
            id:$id
           },
        url:"./ManagerBD/ManagerPasajeros.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
            $("#nombrePasajero").val(data[0]);
            $("#nacionalidadPasajero").val(data[1]); 
            $("#generoPasajero").val(data[2]);
            $("#fechaPasajero").val(data[3]);
            $("#direccionPasajero").val(data[4]);
            $("#telefonoPasajero").val(data[5]);
            $("#idPasajero").val(data[6]);
            $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}

function eliminarPasajero($id){
    $.ajax({
        data:{
            accion:'EP',
            id:$id
           },
        url:"./ManagerBD/ManagerPasajeros.php",
        type:"post",
        success:function(response){
            $( "#idClose" ).trigger( "click" );
            cargarPasajeros();
        }
    });
}