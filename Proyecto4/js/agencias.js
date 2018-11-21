$(function(){
    $("#dataTable_length").css("display","none");
    cargarAgencias();
});

function cargarAgencias(){
    $.ajax({
            data:{
                accion:'SA'
            },
            url:"./ManagerBD/ManagerAgencias.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyAgencias").html(response);
            }
        });
}

function guardarAgencia(){
    $.ajax({
            data:{
                accion:'GA',
                nombreAgencia:$("#nombreAgencia").val(), 
                origenAgencia:$("#origenAgencia").val(), 
                ciudadAgencia:$("#ciudadAgencia").val(),
                idAgencia:$("#idAgencia").val(),
                direccionAgencia:$("#direccionAgencia").val(),
                tipoAgencia:$("#tipoAgencia").val(),
                telefonoAgencia:$("#telefonoAgencia").val()
                
            },
            url:"./ManagerBD/ManagerAgencias.php",
            type:"post",
            success:function(response){
                $( "#idClose" ).trigger( "click" );
                cargarAgencias();
            }
        });
}

function cargarAgencia($id){
    $.ajax({
        data:{
            accion:'SAI',
            id:$id
           },
        url:"./ManagerBD/ManagerAgencias.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
            $("#nombreAgencia").val(data[0]);
            $("#tipoAgencia").val(data[1]);
            $("#origenAgencia").val(data[2]); 
            $("#ciudadAgencia").val(data[3]);
            $("#direccionAgencia").val(data[4]);
            $("#telefonoAgencia").val(data[5]);
            $("#idAgencia").val(data[6]);
            $( "#idModal" ).trigger( "click" );
           
        }
    });
}

function eliminarAgencia($id){
    $.ajax({
        data:{
            accion:'EA',
            id:$id
           },
        url:"./ManagerBD/ManagerAgencias.php",
        type:"post",
        success:function(response){
            cargarAgencias();
        }
    });
}