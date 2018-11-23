


$( document ).ready(function() {


  cargarPromotores();

});


function cargarPromotores(){
    $.ajax({
            data:{
                accion:'SP'
            },
            url:"./server/Promotores.php",
            type:"post",
            success:function(response){
                $("#bodyPromotores").html(response);
            }
        });
}


function agregarPromotor(){



    $.ajax({
            data:{
          accion:'AP',
				  cedulaPersona: $("#cedulaPersona").val(),
			    nombrePersona: $("#nombrePersona").val(),
			    direccionPersona: $("#direccionPersona").val(),
          telefonoPersona:$("#telefonoPersona").val(),
          comision:$("#comision").val(),
          codigoPromotor:$("#codigoPromotor").val(),
          codigoPersona:$("#codigoPersona").val()

            },
            url:"./server/Promotores.php",
            type:"post",
            success:function(response){
            alert("promotor agregador exitosamente");


            cargarPromotores();

            $("#codigoPromotor").val("0");
            $("#codigoPersona").val("0");

          }
        });

}


function cargarPromotor($Codigo,$Id){

    $.ajax({
        data:{
            accion:'CA',
            codigo:$Codigo

           },
        url:"./server/Promotores.php",
        type:"post",
        success:function(response){

            var data = response.split(',');

            $("#codigoPromotor").val(data[0]);
		      	$("#comision").val(data[1]);


        }
    });


    $.ajax({
        data:{
            accion:'CP',
            Id:$Id
           },
        url:"./server/Promotores.php",
        type:"post",
        success:function(response){

            var data = response.split(',');

            $("#codigoPersona").val(data[0]);
            $("#cedulaPersona").val(data[1]);
            $("#nombrePersona").val(data[2]);
            $("#direccionPersona").val(data[3]);
            $("#telefonoPersona").val(data[4]);


            $( "#myModalPromotor" ).modal("show");

        }
    });

}

    function eliminarPromotor($codigo , $Id){

        $.ajax({
            data:{
                accion:'EPE',
                codigo:$codigo,
                Id: $Id
               },
            url:"./server/Promotores.php",
            type:"post",
            success:function(response){


              alert("promotor eliminado exitosamente");
              cargarPromotores();


            }
        });
    }
