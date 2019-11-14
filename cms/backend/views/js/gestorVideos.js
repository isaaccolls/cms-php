// area vista previa de videos
if ($("#galeriaVideo").html() == 0) {
    $("#galeriaVideo").css({"height": "100px"});
} else {
    $("#galeriaVideo").css({"height": "auto"});
}

// subir videos
$("#subirVideo").change(function() {
    video = this.files[0];
    videoSize = video.size;
    videoType = video.type;

    if (Number(videoSize) > 50000000) {
        $("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 2mb</div>');
    } else {
        $(".alerta").remove();
    }

    if (videoType == "video/mp4") {
        $(".alerta").remove();
    } else {
        $("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El archivo debe ser mp4 🙃</div>');
    }

    // mostrar video
    if (Number(videoSize) < 50000000 && videoType == "video/mp4") {
        var datos = new FormData();

        datos.append("video", video);

        $.ajax({
            url: "views/ajax/gestorVideos.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#galeriaVideo").before('<img src="views/images/status.gif" id="status">');
            },
            success: function(respuesta) {
                // console.log('respuesta', respuesta);
                $("#status").remove();
                $("#galeriaVideo").css({"height": "auto"});
                $("#galeriaVideo").append('<li><span class="fa fa-times"></span><video controls><source src="' + respuesta.slice(6) + '" type="video/mp4"></video></li>');
                swal({
                    title: "¡OK!",
                    text: "¡El video se subió correctamente",
                    type: "success",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        window.location = "videos";
                    }
                });
            },
            error: function(error) {
                console.log("fuck 🙃", error);
            }
        })
    }
});

// eliminar video
$(".eliminarVideo").click(function() {
    if ($(".eliminarVideo").length == 1) {
        $("#galeriaVideo").css({"height": "100px"});
    }
    idVideo = $(this).parent().attr("id");
    rutaVideo = $(this).attr("ruta");

    $(this).parent().remove();

    var borrarVideo = new FormData();
    borrarVideo.append("idVideo", idVideo);
    borrarVideo.append("rutaVideo", rutaVideo);
    $.ajax({
        url: "views/ajax/gestorVideos.php",
        method: "POST",
        data: borrarVideo,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta) {
            console.log(respuesta);
        },
        error: function(error) {
            console.log("fuck 🙃", error);
        }
    });
});