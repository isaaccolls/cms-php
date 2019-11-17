// mostrar mensajes
$(".leerMensaje").click(function() {
    id = $(this).parent().attr("id");
    // console.log("👽 id", id);
    fecha = $("#" + id).children("p").html();
    nombre = $("#" + id).children("h3").html();
    email = $("#" + id).children("h5").html();
    mensaje = $("#" + id).children("input").val();
    // console.log(fecha, nombre, email, mensaje);
    $("#visorMensajes").html('<div class="well well-sm"><h3>' + nombre + '</h3><h5>' + email + '</h5><p style="background:#fff; padding:10px">' + mensaje + '</p><button class="btn btn-info btn-sm responderMensaje">Responder</button></div>');


    $(".responderMensaje").click(function() {
        enviarEmail = $(this).parent().children("h5").html();
        enviarNombre = $(this).parent().children("h3").html();
        $("#visorMensajes").html('<form method="post"><p>Para: <input type="email" value="' + enviarEmail.slice(6) + '" name="enviarEmail" style="border: 0" readonly><input type="hidden" value="' + enviarNombre.slice(4) + '" name="enviarNombre"></p><input type="text" name="enviarTitulo" placeholder="Título del Mensaje" class="form-control"><textarea name="enviarMensaje" cols="30" rows="5" placeholder="Escribe tu mensaje..." class="form-control"></textarea><input type="submit" class="form-control btn btn-primary" value="Enviar"></form>');
    });

});
