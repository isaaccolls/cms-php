<?php

class MensajesController {
    // mostrar mensajes en la vista
    public function mostrarMensajesController() {
        $respuesta = MensajesModel::mostrarMensajesModel("mensajes");
        foreach ($respuesta as $row => $item) {
            echo '
                <div class="well well-sm" id="' . $item["id"] . '">
                    <a href="index.php?action=mensajes&idBorrar=' . $item["id"] . '"><span class="fa fa-times pull-right"></span></a>
                    <p>' . $item["fecha"] . '</p>
                    <h3>De: ' . $item["nombre"] . '</h3>
                    <h5>Email: ' . $item["email"] . '</h5>
                    <input type="text" class="form-control" value="' . $item["mensaje"] . '" readonly>
                    <br>
                    <button class="btn btn-info btn-sm leerMensaje">Leer</button>
                </div>
            ';
        }
    }

    // borrar mensajes
    public function borrarMensajesController() {
        if (isset($_GET["idBorrar"])) {
            $datosController = $_GET["idBorrar"];
            $respuesta = MensajesModel::borrarMensajesModel($datosController, "mensajes");
            if ($respuesta == "ok") {
                echo '
                    <script>
                        swal({
                            title: "¡OK!",
                            text: "¡El mensaje se ha borrado correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                window.location = "mensajes";
                            }
                        });
                    </script>
                ';
            } else {

            }
        }
    }

    // responder mensajes
    public function responderMensajesController() {
        if (isset($_POST["enviarEmail"])) {
            $email = $_POST["enviarEmail"];
            $nombre = $_POST["enviarNombre"];
            $titulo = $_POST["enviarTitulo"];
            $mensaje = $_POST["enviarMensaje"];

            $para = $email . ', ';
            $para .= "colls_isaac@hotmail.com";
            $titulo = "Respuesta a tu mensaje";
            $mensaje = '
                <<!DOCTYPE html>
                <html>
                <head>
                    <title>Respuesta a su Mensaje</title>
                </head>
                <body>
                    <h1>Hola ' . $nombre . '</h1>
                    <p>' . $mensaje . '</p>
                    <br>
                    <p><b>Isaac Colls</b> 👽</p>
                </body>
                </html>
            ';
            $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
            $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $cabeceras .= 'From: <colls_isaac@yahoo.es>' . "\r\n";

            $envio = mail($para, $titulo, $mensaje, $cabeceras);

            if ($envio) {
                echo '
                    <script>
                        swal({
                            title: "¡OK!",
                            text: "¡El mensaje se ha enviado correctamente!",
                            type: "success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                window.location = "mensajes";
                            }
                        });
                    </script>
                ';
            } else {
                echo '<div class="alert alert-danger">No se envio el mensaje!!</div>';
            }

        }
    }

    // enviar mensajes masivos
    public function mensajesMasivosController() {
        if (isset($_POST["tituloMasivo"])) {
            $respuesta = MensajesModel::seleccionarEmailSuscriptores("suscriptores");
            foreach ($respuesta as $row => $item) {
                $titulo = $_POST["tituloMasivo"];
                $mensaje = $_POST["mensajeMasivo"];

                $titulo = "Respuesta a tu mensaje";
                $para = $item["email"] . ', ';
                // $para .= "colls_isaac@hotmail.com";
                $mensaje = '
                    <<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Respuesta a su Mensaje</title>
                    </head>
                    <body>
                        <h1>Hola ' . $item["nombre"] . '</h1>
                        <p>' . $mensaje . '</p>
                        <br>
                        <p><b>Isaac Colls</b> 👽</p>
                    </body>
                    </html>
                ';
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $cabeceras .= 'From: <colls_isaac@yahoo.es>' . "\r\n";

                $envio = mail($para, $titulo, $mensaje, $cabeceras);

                if ($envio) {
                    echo '
                        <script>
                            swal({
                                title: "¡OK!",
                                text: "¡El mensaje se ha enviado correctamente!",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    window.location = "mensajes";
                                }
                            });
                        </script>
                    ';
                } else {
                    echo '<div class="alert alert-danger">No se envio el mensaje!!</div>';
                }
            }
        }
    }
}