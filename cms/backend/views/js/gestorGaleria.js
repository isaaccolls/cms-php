//  just for body prevention
$("body").on("dragover", function(e) {
    e.preventDefault();
    e.stopPropagation();
});

$("body").on("drop", function(e) {
    e.preventDefault();
    e.stopPropagation();
});

//  area arrastre de imagenes
if ($("#lightbox").html() == 0) {
    $("#lightbox").css({"height": "100px"});
} else {
    $("#lightbox").css({"height": "auto"});
}

// subir multiples imagenes
$("#lightbox").on("dragover", function(e) {
    e.preventDefault();
    e.stopPropagation();

    $("#lightbox").css({"background": "url(views/images/pattern.JPG"});
});

// soltar imagenes
var imagenSize = [];
var imagenType = [];
$("#lightbox").on("drop", function(e) {
    e.preventDefault();
    e.stopPropagation();

    $("#lightbox").css({"background": "white"});

    var archivo = e.originalEvent.dataTransfer.files;
    // console.log("archivo", archivo);
    for (var i = 0; i < archivo.length; i++) {
        imagen = archivo[i];
        imagenSize.push(imagen.size);
        imagenType.push(imagen.type);

        if (Number(imagenSize[i] > 2000000)) {
            $('#lightbox').before('<div class="alert alert-warning alerta text-center">El archivo ' + imagen.name + ' excede el peso permitido, 2Mb</div>');
        } else {
            $(".alerta").remove();
        }

        if (imagenType[i] == 'image/jpeg' || imagenType[i] == 'image/png') {
            $(".alerta").remove();
        } else {
            $("#lightbox").before('<div class="alert alert-warning alerta text-center">El archivo debe ser formato JPEG o PNG</div>');
        }

        // subir imagen al servidor
        if ((Number(imagenSize[i]) < 2000000) && (imagenType[i] == 'image/jpeg' || imagenType[i] == 'image/png')) {
            var datos = new FormData();
            datos.append("imagen", imagen);

            $.ajax({
                url:"views/ajax/gestorGaleria.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#lightbox").before('<img src="views/images/status.gif" id="status">');
                },
                success: function(respuesta) {
                    console.log('respuesta', respuesta);
                    $("#status").remove();

                    if (respuesta == 0) {
                        $("#lightbox").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 1024px * 768px</div>');
                    } else {
                        $('#lightbox').css({"height":"auto"});
                        $("#lightbox").append('<li><span class="fa fa-times"></span><a rel="grupo" href="' + respuesta.slice(6) + '"><img src="' + respuesta.slice(6) + '"></a></li>');

                        swal({
                            title: "¡OK!",
                            text: "¡La imagen se subió correctamente",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }, function(isConfirm) {
                            if (isConfirm) {
                                window.location = "galeria";
                            }
                        });
                    }
                },
                error: function(error) {
                    console.log("fuck 😓");
                    console.log(error);
                }
            });
        }
    }
});

// eliminar item galeria
$(".eliminarFoto").click(function() {

    if ($(".eliminarFoto").length == 1) {
        $("#lightbox").css({"height": "100px"});
    }

    var idGaleria = $(this).parent().attr("id");
    var rutaGaleria = $(this).attr("ruta");
    $(this).parent().remove();

    var borrarItem = new FormData();
    borrarItem.append("idGaleria", idGaleria);
    borrarItem.append("rutaGaleria", rutaGaleria);
    $.ajax({
        url: "views/ajax/gestorGaleria.php",
        method: "POST",
        data: borrarItem,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            // console.log("a segun borro xD", respuesta);
        }
    });
});

// order items galeria
var almacenarOrdenId = [];
var ordenItem = [];
$("#ordenarGaleria").click(function() {
    $("#ordenarGaleria").hide();
    $("#guardarGaleria").show();
    $("#lightbox").css({"cursor": "move"});
    $("#lightbox span").hide();
    $("#lightbox").sortable({
        revert: true,
        connectWith: ".bloqueGaleria",
        handle: ".handleImg",
        stop: function(event) {
            for (var i = 0; i < $("#lightbox li").length; i++) {
                almacenarOrdenId[i] = event.target.children[i].id;
                ordenItem[i] = i + 1;
            }
        }
    });
});

$("#guardarGaleria").click(function() {
    $("#ordenarGaleria").show();
    $("#guardarGaleria").hide();

    for (var i = 0; i < $("#lightbox li").length; i++) {
        var actualizarOrden = new FormData();
        actualizarOrden.append("actualizarOrdenGaleria", almacenarOrdenId[i]);
        actualizarOrden.append("actualizarOrdenItem", ordenItem[i]);
        $.ajax({
            url: "views/ajax/gestorGaleria.php",
            method: "POST",
            data: actualizarOrden,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {
                $("#lightbox").html(respuesta);

                swal({
                    title: "¡OK!",
                    text: "¡El orden se ha actualizado correctamente",
                    type: "success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        window.location = "galeria";
                    }
                });

            }
        })
    }
});