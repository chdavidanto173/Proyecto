

$( document ).ready(function() {

  cargarEventoCombo();
  cargarEntradas();

});


function cargarEventoCombo(){
    $.ajax({
            data:{
                accion:'CCombE'
            },
            url:"./server/Entradas.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#comboEventos").html(response);
            }
        });
}


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


function cargarEntrada($cod){
    $.ajax({
        data:{
            accion:'SEI',
            cod:$cod
           },
        url:"./server/Entradas.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
	        $('[name=entraCodigo]').val(data[0]);
			$("#cantidad").val(data[1]);
			$("#precio").val(data[2]);
			$("#tipoEntrada").val(data[4]);
            $('[name=comboEventos]').val( data[5] );

            $( "#idmyModalEntrada" ).trigger( "click" );
            cargarEntradas();
        }
    });
}


function agregarEntrada(){

    $.ajax({
            data:{
                accion:'AE',
                precioEntrada:parseFloat($("#precio").val()),
                cantidadEntrada:parseInt($("#cantidad").val()),
                tipoEntrada:$( "#tipoEntrada option:selected" ).text(),
				codEntrada:$("#entraCodigo").val(),
				eventoEntrada: $("#comboEventos").val()

            },
            url:"./server/Entradas.php",
            type:"post",
            success:function(response){
              //  cargarAerolineas();
              //   $( "#idClose" ).trigger( "click" );
              cargarEntradas();
			  alert("entrada agregada exitosamente");
            }
        });
}


function eliminarEntrada($codigo){
    $.ajax({
        data:{
            accion:'EE',
            codigo:$codigo
           },
        url:"./server/Entradas.php",
        type:"post",
        success:function(response){
	      alert("Entrada eliminada exitosamente");
          cargarEntradas();
        }
    });
}
