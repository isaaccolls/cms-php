<?php

require_once "../../controllers/gestorMensajes.php";
require_once "../../models/gestorMensajes.php";

// clase y metodos
class Ajax {
    // revisar mensajes
    public $revisionMensajes;
    public function gestorRevisionMensajesAjax() {
        $datos = $this->revisionMensajes;
        $respuesta = MensajesController::mensajesRevisadosController($datos);
        echo $respuesta;
    }
}

// objetos
if (isset($_POST["revisionMensajes"])) {
    $a = new Ajax();
    $a->revisionMensajes = $_POST["revisionMensajes"];
    $a->gestorRevisionMensajesAjax();
}