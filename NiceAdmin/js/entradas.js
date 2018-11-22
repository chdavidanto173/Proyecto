

$( document ).ready(function() {


  cargarEntradas();

});

function cargarEntradas(){
    $.ajax({
            data:{
                accion:'CE'
            },
            url:"./server/Entradas.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#bodyEntradas").html(response);
            }
        });
}



function agregarEntrada(){

    $.ajax({
            data:{
                accion:'AE',
                precioEntrada:parseFloat($("#precio").val()),
                cantidadEntrada:parseInt($("#cantidad").val()),
                tipoEntrada:$( "#tipoEntrada option:selected" ).text()

            },
            url:"./server/Entradas.php",
            type:"post",
            success:function(response){
              //  cargarAerolineas();
              //   $( "#idClose" ).trigger( "click" );
              alert("entrada agregada exitosamente");
              cargarEntradas();
            }
        });
}


function eliminarEntrada($codigo){
  alert("entro");
    $.ajax({
        data:{
            accion:'EE',
            codigo:$codigo
           },
        url:"./server/Entradas.php",
        type:"post",
        success:function(response){
          cargarEntradas();
        }
    });
}
