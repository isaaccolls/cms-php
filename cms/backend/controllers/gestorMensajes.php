<?php

class MensajesController {
    // mostrar mensajes en la vista
    public function mostrarMensajesController() {
        $respuesta = MensajesModel::mostrarMensajesModel("mensajes");
        foreach ($respuesta as $row => $item) {
            echo '
                <div class="well well-sm">
                    <a href="index.php?action=mensajes&idBorrar=' . $item["id"] . '"><span class="fa fa-times pull-right"></span></a>
                    <p>' . $item["fecha"] . '</p>
                    <h3>De: ' . $item["nomre"] . '</h3>
                    <h5>Email: ' . $item["email"] . '</h5>
                    <input type="text" class="form-control" value="' . $item["mensaje"] . '" readonly>
                    <br>
                    <button class="btn btn-info btn-sm">Leer</button>
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
}