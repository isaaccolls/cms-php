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
                            text: "¡El usuario ha sido creado correctamente!",
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

    // editar perfil
    public function editarPerfilController() {
        $ruta = "";
        if (isset($_POST["editarUsuario"])) {
            if (isset($_FILES["editarImagen"]["tmp_name"])) {
                $imagen = $_FILES["editarImagen"]["tmp_name"];
                $aleatorio = mt_rand(100, 999);
                $ruta = "views/images/perfiles/perfil" . $aleatorio . ".jpg";
                $origen = imagecreatefromjpeg($imagen);
                $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 100, "height" => 100]);
                imagejpeg($destino, $ruta);
            }
            if ($ruta == "") {
                $ruta = $_POST["editarPhoto"];
            }
            if (($ruta != "") && ($_POST["editarPhoto"] != "views/images/photo.jpg")) {
                unlink($_POST["editarPhoto"]);
            }
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"]) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["editarEmail"])) {
                $encriptar = crypt($_POST["editarPassword"], 'llave');
                $datosController = array(
                    "id" => $_POST["idPerfil"],
                    "usuario" => $_POST["editarUsuario"],
                    "password" => $encriptar,
                    "email" => $_POST["editarEmail"],
                    "rol" => $_POST["editarRol"],
                    "photo" => $ruta
                );
                $respuesta = GestorPerfilesModel::editarPerfilModel($datosController, "usuarios");
                if ($respuesta == "ok") {
                    $_SESSION["id"] = $_POST["idPerfil"];
                    $_SESSION["usuario"] = $_POST["editarUsuario"];
                    $_SESSION["password"] = $encriptar;
                    $_SESSION["email"] = $_POST["editarEmail"];
                    $_SESSION["photo"] = $ruta;
                    $_SESSION["rol"] = $_POST["editarRol"];
                    echo '
                        <script>
                            swal({
                                title: "¡OK!",
                                text: "¡El usuario ha sido editado correctamente!",
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
                    echo '<div class="alert alert-danger">db error 🙃</div>';
                }
            } else {
                echo '<div class="alert alert-danger">No se permiten caracteres especiales!(backend validation 😉)</div>';
            }
        }
    }
}