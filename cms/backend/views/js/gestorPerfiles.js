// mostrar formulario registro perfil
$("#registrarPerfil").click(function() {
    $("#formularioPerfil").toggle("fast");
})

// subir foto
$("#subirFotoPerfil").change(function() {
    $("#subirFotoPerfil").attr("name", "nuevaImagen");
});

// editar perfil
$("#btnEditarPerfil").click(function() {
    $("#editarPerfil").hide("fast");
    $("#formEditarPerfil").show("fast");
});

// cambiar foto del perfil
$("#cambiarFotoPerfil").change(function() {
    $("#cambiarFotoPerfil").attr("name", "editarImagen");
});