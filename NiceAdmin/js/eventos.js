


$( document ).ready(function() {

  cargarLugarCombo();
  cargarEventos();

});


function cargarLugarCombo(){
    $.ajax({
            data:{
                accion:'SL'
            },
            url:"./server/Eventos.php",
            type:"post",
            success:function(response){
                console.log(response);
                $("#comboLugares").html(response);
            }
        });
}



function agregarEvento(){

    $.ajax({
            data:{
                accion:'AE',				
				eveNombre: $("#eveNombre").val(),
			    eveFecha: $("#eveFecha").val(),
			    eveDuracion: $("#comboLugares").val(),
                eveLugar:parseInt($("#comboLugares").val()),
				codEvento:$("#eveCodigo").val()
            },
            url:"./server/Eventos.php",
            type:"post",
            success:function(response){
              cargarEventos();
			  alert("Evento Agregado exitosamente");
            }
        });
}

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

function cargarEvento($cod){
    $.ajax({
        data:{
            accion:'SEI',
            cod:$cod
           },
        url:"./server/Eventos.php",
        type:"post",
        success:function(response){
            console.log(response);
            var data = response.split(',');
	        $('[name=eveCodigo]').val( data[0] );
            $('[name=eveNombre]').val( data[1] );
            $("#eveFecha").val(data[2]);
			$("#eveDuracion").val(data[3]);
			$("#comboLugares").val(data[4]);
            $( "#idmyModalEvento" ).trigger( "click" );
            cargarEventos();
        }
    });
}



function eliminarEvento($codigo){
 
    $.ajax({
        data:{
            accion:'EE',
            codigo:$codigo
           },
        url:"./server/Eventos.php",
        type:"post",
        success:function(response){
          cargarEventos();
		  alert("Evento eliminado exitosamente");
        }
    });
}
