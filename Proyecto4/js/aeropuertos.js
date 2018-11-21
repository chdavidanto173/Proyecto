$(function(){
    $("#dataTable_length").css("display","none");
    cargarAeropuertos();
});

function cargarAeropuertos(){
    $.ajax({
            data:{
                accion:'SA'
            },
            url:"./ManagerBD/ManagerAeropuertos.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyAeropuertos").html(response);
            }
        });
}

function guardarAeropuerto(){
    $.ajax({
            data:{
                accion:'GA',
                nombreAeropuerto:$("#nombreAeropuerto").val(), 
                origenAeropuerto:$("#origenAeropuerto").val(), 
                ciudadAeropuerto:$("#ciudadAeropuerto").val(),
                idAeropuerto:$("#idAeropuerto").val(),
                aerolineaAeropuerto:$("#aerolineaAeropuerto").val()
                
            },
            url:"./ManagerBD/ManagerAeropuertos.php",
            type:"post",
            success:function(response){
                $( "#idClose" ).trigger( "click" );
                cargarAeropuertos();
            }
        });
}

function cargarAeropuerto($id){
    $.ajax({
        data:{
            accion:'SAI',
            id:$id
           },
        url:"./ManagerBD/ManagerAeropuertos.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
            $("#nombreAeropuerto").val(data[0]);
            $("#origenAeropuerto").val(data[1]); 
            $("#ciudadAeropuerto").val(data[2]);
            $("#aerolineaAeropuerto").val(data[3]);
            $("#idAeropuerto").val(data[4]);
            $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}

function eliminarAeropuerto($id){
    $.ajax({
        data:{
            accion:'EA',
            id:$id
           },
        url:"./ManagerBD/ManagerAeropuertos.php",
        type:"post",
        success:function(response){
            cargarAeropuertos();
        }
    });
}