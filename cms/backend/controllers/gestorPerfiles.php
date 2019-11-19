<?php

class GestorPerfiles {
    // guardar perfil
    public function guardarPerfilController() {
        $ruta = "";
        if (isset($_POST["nuevoUsuario"])) {
            if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
                $imagen = $_FILES["nuevaImagen"]["tmp_name"];
                $aleatorio = mt_rand(100, 999);
                $ruta = "views/images/perfiles/perfil" . $aleatorio . ".jpg";
                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 100, "height" => 100]);
                imagejpeg($destino, $ruta);
            }
            if ($ruta == "") {
                $ruta = "views/images/photo.jpg";
            }
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["nuevoEmail"])) {
                $encriptar = crypt($_POST["nuevoPassword"], 'llave');
                $datosController = array(
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "email" => $_POST["nuevoEmail"],
                    "rol" => $_POST["nuevoRol"],
                    "photo" => $ruta
                );
            }
            $respuesta = GestorPerfilesModel::guardarPerfilModel($datosController, "usuarios");
            if ($respuesta == "ok") {
                echo '
                    <script>
                        swal({
                            title: "¡OK!",
                            text: "¡El usuario ha sido creadp correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                window.location = "perfil";
                            }
                        });
                    </script>
                ';
            } else {
                echo '<div class="alert alert-danger">No se permiten caracteres especiales!(backend validation 😉)</div>';
            }
        }
    }

    // visualizar perfiles
    public function verPerfilesController(){
        $respuesta = GestorPerfilesModel::verPerfilesModel("usuarios");
        $rol = "";
        foreach ($respuesta as $key => $value) {
            if ($value["rol"] == 0) {
                $rol = "Administrador";
            } else {
                $rol = "Editor";
            }
            echo '
                <tr>
                    <td>' . $value["usuario"] . '</td>
                    <td>' . $rol . '</td>
                    <td>' . $value["email"] . '</td>
                    <td>
                        <span class="btn btn-info fa fa-pencil"></span>
                        <span class="btn btn-danger fa fa-times"></span>
                    </td>
                </tr>
            ';
        }
    }
}