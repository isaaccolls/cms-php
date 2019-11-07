/*=====================================
Agregar articulo
======================================*/
$('#btnAgregarArticulo').click(function() {
    // console.log("click btnAgregarArticulo");
    $("#agregarArticulo").toggle(400);
});

/*=====================================
Subir imagen a traves del input
======================================*/
$('#subirFoto').change(function() {
    var imagen = this.files[0];
    // console.log("👽", imagen);

    var imagenSize = imagen.size;
    if (Number(imagenSize) > 2000000) {
        $("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 2mb</div>');
    } else {
        $(".alerta").remove();
    }

    var imagenType = imagen.type;
    if (imagenType == 'image/jpeg' || imagenType == 'image/png') {
        $(".alerta").remove();
    } else {
        $("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPEG o PNG</div>');
    }

    /*=====================================
    Mostrar imagen con Ajax
    ======================================*/
    if ((Number(imagenSize) < 2000000) && (imagenType == 'image/jpeg' || imagenType == 'image/png')) {
        var datos = new FormData();
        datos.append("imagen", imagen);
        $.ajax({
            url: "views/ajax/gestorArticulos.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                // console.log("beforeSend image 😦");
                $("#arrastreImagenArticulo").before('<img src="views/images/status.gif" id="status">');
            },
            success: function(respuesta) {
                // console.log("respuesta👽", respuesta);
                $("#status").remove();
                if (respuesta == 0) {
                    $("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 800px * 400px</div>');
                } else {
                    $("#arrastreImagenArticulo").html('<div id="imagenArticulo"><img src="' + respuesta.slice(6) + '" class="img-thumbnail"></div>');
                }
            },
            error: function(error) {
                console.log("fuck 😓");
                console.log(error);
            }
        })
    }
});