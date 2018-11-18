
$(document).ready(function () {

    $("#ac").click(function () {
  

        $.ajax({
            type: "POST",
            url: '@Url.Action("crearBD","Home")',
            content: "application/json; charset=utf-8",
            dataType: "json",
            data: null,
            success: function (d) {
                if (d.success == true)
                    alert('Se ha creado la base de datos!!');
                else { }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert('Error!!');
            }
        });
    });
   

});


