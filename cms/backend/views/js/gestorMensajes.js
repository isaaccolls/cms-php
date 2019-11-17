// mostrar mensajes
$(".leerMensaje").click(function() {
    id = $(this).parent().attr("id");
    // console.log("👽 id", id);
    fecha = $("#" + id).children("p").html();
    nombre = $("#" + id).children("h3").html();
    email = $("#" + id).children("h5").html();
    mensaje = $("#" + id).children("input").val();
    // console.log(fecha, nombre, email, mensaje);
    $("#visorMensajes").html('<div class="well well-sm"><span class="fa fa-times pull-right"></span><h3>' + nombre + '</h3><h5>' + email + '</h5><p style="background:#fff; padding:10px">' + mensaje + '</p><button class="btn btn-info btn-sm responderMensaje">Responder</button></div>');


    $(".responderMensaje").click(function() {
        enviarEmail = $(this).parent().children("h5").html();
        enviarNombre = $(this).parent().children("h3").html();
        $("#visorMensajes").html('<form method="POST"><p>Para: ' + enviarEmail.slice(6) + '<br>' + enviarNombre.slice(4) + '</p><input type="text" placeholder="Título del Mensaje" class="form-control"><textarea name="" id="" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea><input type="button" class="form-control btn btn-primary" value="Enviar"></form>');
    });

});
