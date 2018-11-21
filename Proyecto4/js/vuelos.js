$(function(){
    $("#dataTable_length").css("display","none");
    cargarVuelos();
});

function cargarVuelos(){
    $.ajax({
            data:{
                accion:'SV'
            },
            url:"./ManagerBD/ManagerVuelos.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyVuelos").html(response);
            }
        });
}

function guardarVuelo(){
    $.ajax({
            data:{
                accion:'GV',
                destinoVuelo:$("#destinoVuelo").val(), 
                numeroVuelo:$("#numeroVuelo").val(), 
                costoVuelo:$("#costoVuelo").val(),
                fechaSalidaVuelo:$("#fechaSalidaVuelo").val(),
                fechaLlegadaVuelo:$("#fechaLlegadaVuelo").val(),
                idVuelo:$("#idVuelo").val()
                
            },
            url:"./ManagerBD/ManagerVuelos.php",
            type:"post",
            success:function(response){
                cargarVuelos();
                $( "#idClose" ).trigger( "click" );
            }
        });
}

function cargarVuelo($id){
    $.ajax({
        data:{
            accion:'SVI',
            id:$id
           },
        url:"./ManagerBD/ManagerVuelos.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
            $("#destinoVuelo").val(data[0]);
            $("#numeroVuelo").val(data[1]); 
            $("#costoVuelo").val(data[2]);
            $("#fechaSalidaVuelo").val(data[3]);
            $("#fechaLlegadaVuelo").val(data[4]);
            $("#idVuelo").val(data[5]);
            $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}

function eliminarVuelo($id){
    $.ajax({
        data:{
            accion:'EV',
            id:$id
           },
        url:"./ManagerBD/ManagerVuelos.php",
        type:"post",
        success:function(response){
            cargarVuelos();
        }
    });
}