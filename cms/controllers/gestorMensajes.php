<?php

class MensajesController {

    public function registroMensajesController() {
        if (isset($_POST["nombre"])) {
            if (preg_match('/^[a-zA-Z\s]+$/', $_POST["nombre"]) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["email"]) && preg_match('/^[a-zA-Z0-9\s\.,]+$/', $_POST["mensaje"])) {

                $datosController = array(
                    "nombre" => $_POST["nombre"],
                    "email" => $_POST["email"],
                    "mensaje" => $_POST["mensaje"]
                );
                $respuesta = MensajesModel::registroMensajesModel($datosController, "mensajes");

                if ($respuesta == "ok") {
                    echo '
                        <script>
                            console.log("asd");
                            swal({
                                title: "¡OK!",
                                text: "¡EL mensaje ha sido enviado correctamente",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }, function(isConfirm) {
                                if (isConfirm) {
                                    window.location = "index.php";
                                }
                            });
                        </script>
                    ';
                }
            } else {
                error_log("fuck C=");
                echo '<div class="alert alert-danger">No se puedo enviar el mensaje, no se permiten caracteres especiales!(backend validation 😉)<div>';
            }
        }
    }
}