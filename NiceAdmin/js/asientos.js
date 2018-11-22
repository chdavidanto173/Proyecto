
function cargarAsientos(){
    $.ajax({
            data:{
                accion:'SA'
            },
            url:"./server/ManagerAsientos.php",
            type:"post",
            success:function(response){
                console.log(response);
                alert(response);

                $("#bodyAsientos").html(response);
            }
        });
}





function guardarAerolinea(){    // Revisar y Ajustar
    $.ajax({
            data:{
                accion:'GA',
                codigoAsiento:$("#codigoAsiento").val(),
                numeroAsiento:$("#numeroAsiento").val(),
                filaAsiento:$("#filaAsiento").val()
            },
           url:"./Server/ManagerAsientos.php",
            type:"post",
            success:function(response){
                cargarAsientos();
				//("#idClose" ).trigger( "click" );
            }
        });
}

function cargarAsiento($codigo){  // Revisar y Ajustar
    $.ajax({
        data:{
            accion:'SAC',
            id:$id
           },
        url:"./Server/ManagerAsientos.php",
        type:"post",
        success:function(response){
            var data = response.split(',');
            $("#codigoAsiento").val(data[0]);
            $("#numeroAsiento").val(data[1]);
            $("#filaAsiento").val(data[2]);
           // $( "#idModal" ).trigger( "click" );
           // cargarAerolineas();
        }
    });
}


function eliminarAsiento($codigo){
    $.ajax({
        data:{
            accion:'EA',
            codigo:$codigo
           },
        url:"./Server/ManagerAsientos.php",
        type:"post",
        success:function(response){
            cargarAsientos();
        }
    });
}
