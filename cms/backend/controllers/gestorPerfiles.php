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
                        <a href="#perfil' . $value["id"] . '" data-toggle="modal">
                            <span class="btn btn-info fa fa-pencil"></span>
                        </a>
                        <span class="btn btn-danger fa fa-times"></span>
                    </td>
                </tr>
                <div id="perfil' . $value["id"] . '" class="modal fade">
                    <div class="modal-dialog modal-content">
                        <div class="modal-header" style="border:1px solid #eee">
                            <button type="button" class="close" data-dismiss="modal">X</button>
                            <h3 class="modal-title">Editar Perfil</h3>
                        </div>
                        <div class="modal-body" style="border:1px solid #eee">
                            <form style="padding:0px 10px" method="post" enctype="multipart/form-data">
                                <input name="idPerfil" type="hidden" value="' . $value["id"] . '">
                                <div class="form-group">
                                    <input name="editarUsuario" type="text" class="form-control" value="' . $value["usuario"] . '" required>
                                </div>
                                <div class="form-group">
                                    <input name="editarPassword" type="password" placeholder="Ingrese la Contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input name="editarEmail" type="email" value="' . $value["email"] . '" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <select name="editarRol" class="form-control" required>
                                        <option value="">Seleccione el Rol</option>
                                        <option value="0">Administrador</option>
                                        <option value="1">Editor</option>
                                    </select>
                                </div>
                                <div class="form-group text-center">
                                    <div style="display:block;">
                                        <img src="' . $value["photo"] . '" width="20%" class="img-circle">
                                        <input type="hidden" value="' . $value["photo"] . '" name="editarPhoto">
                                    </div>
                                    <input type="file" class="btn btn-default" name="editarImagen" style="display:inline-block; margin:10px 0">
                                    <p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>
                               </div>
                                <div class="form-group text-center">
                                    <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer" style="border:1px solid #eee">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            ';
        }
    }

    // editar perfil
    public function editarPerfilController() {
        $ruta = "";
        if (isset($_POST["editarUsuario"])) {
            if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {
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
                    if (isset($_POST["actualizarSesion"])) {
                        $_SESSION["id"] = $_POST["idPerfil"];
                        $_SESSION["usuario"] = $_POST["editarUsuario"];
                        $_SESSION["password"] = $encriptar;
                        $_SESSION["email"] = $_POST["editarEmail"];
                        $_SESSION["photo"] = $ruta;
                        $_SESSION["rol"] = $_POST["editarRol"];
                    }
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