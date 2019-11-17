<?php

class MensajesController {

    public function registroMensajesController() {
        if (isset($_POST["nombre"])) {
            if (preg_match('/^[a-zA-Z\s]+$/', $_POST["nombre"]) && preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_POST["email"]) && preg_match('/^[a-zA-Z0-9\s\.,\']+$/', $_POST["mensaje"])) {

                // send email
                // mail(to, subject, message, cabecera del correo)
                // $correoDestino = "colls_isaac@yahoo.es";
                // $asunto = "Testing mensaje de la web";
                // $mensaje = "Nombre: " . $_POST["nombre"] .
                //             "\nEmail: " . $_POST["email"] .
                //             "\nMensaje: " . $_POST["mensaje"];
                // $cabecera = "From: Sitio web" . "\r\n" .
                //             "cc: " . $_POST["email"];

                // $envio = mail($correo, $asunto, $mensaje, $cabecera);
                $envio = true;

                // db
                $datosController = array(
                    "nombre" => $_POST["nombre"],
                    "email" => $_POST["email"],
                    "mensaje" => $_POST["mensaje"]
                );
                // almacenar en db el suscriptor
                $datosSuscriptor = $_POST["email"];
                $revisarSuscriptor = MensajesModel::revisarSuscriptorModel($datosSuscriptor, "suscriptores");
                if (count($revisarSuscriptor["email"]) == 0) {
                    MensajesModel::registroSuscriptoresModel($datosController, "suscriptores");
                }
                // almacenar en db el mensaje
                $respuesta = MensajesModel::registroMensajesModel($datosController, "mensajes");

                // show alert
                if ($envio == true && $respuesta == "ok") {
                    echo '
                        <script>
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