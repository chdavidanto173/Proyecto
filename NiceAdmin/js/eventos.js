


$( document ).ready(function() {


  cargarEventos();

});

function cargarEventos(){
    $.ajax({
            data:{
                accion:'SE'
            },
            url:"./server/Eventos.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyEventos").html(response);
            }
        });
}


function eliminarEvento($codigo){
  alert("entro");
    $.ajax({
        data:{
            accion:'EE',
            codigo:$codigo
           },
        url:"./server/Eventos.php",
        type:"post",
        success:function(response){
          cargarEventos();
        }
    });
}
