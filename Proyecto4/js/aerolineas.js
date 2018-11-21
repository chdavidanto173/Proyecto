$(function(){
    $("#dataTable_length").css("display","none");
    cargarAerolineas();
});

function cargarAerolineas(){
    $.ajax({
            data:{
                accion:'SA'
            },
            url:"./ManagerBD/ManagerAerolineas.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyAerolineas").html(response);
            }
        });
}

function guardarAerolinea(){
    $.ajax({
            data:{
                accion:'GA',
                nombreAerolinea:$("#nombreAerolinea").val(), 
                origenAerolinea:$("#origenAerolinea").val(), 
                administradorAerolinea:$("#adminAerolinea").val(), 
                telefonoAerolinea:$("#telefonoAerolinea").val(),
                idAerolinea:$("#idAerolinea").val()
            },
            url:"./ManagerBD/ManagerAerolineas.php",
            type:"post",
            success:function(response){
                cargarAerolineas();
                $( "#idClose" ).trigger( "click" );
            }
        });
}

function cargarAerolinea($id){
    $.ajax({
        data:{
            accion:'SAI',
            id:$id
           },
        url:"./ManagerBD/ManagerAerolineas.php",
        type:"post",
        success:function(response){
            var data = response.split(',');
            $("#nombreAerolinea").val(data[0]);
            $("#origenAerolinea").val(data[1]); 
            $("#adminAerolinea").val(data[2]);
            $("#telefonoAerolinea").val(data[3]);
            $("#idAerolinea").val(data[4]);
            $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}

function eliminarAerolinea($id){
    $.ajax({
        data:{
            accion:'EA',
            id:$id
           },
        url:"./ManagerBD/ManagerAerolineas.php",
        type:"post",
        success:function(response){
            cargarAerolineas();
        }
    });
}