// mostrar formulario registro perfil
$("#registrarPerfil").click(function() {
    $("#formularioPerfil").toggle("fast");
})

// subir foto
$("#subirFotoPerfil").change(function() {
    $("#subirFotoPerfil").attr("name", "nuevaImagen");
});

