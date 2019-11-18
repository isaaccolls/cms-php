<?php

require_once "../../controllers/gestorMensajes.php";
require_once "../../controllers/gestorSuscriptores.php";

require_once "../../models/gestorMensajes.php";
require_once "../../models/gestorSuscriptores.php";

// clase y metodos
class Ajax {
    // revisar mensajes
    public $revisionMensajes;
    public function gestorRevisionMensajesAjax() {
        $datos = $this->revisionMensajes;
        $respuesta = MensajesController::mensajesRevisadosController($datos);
        echo $respuesta;
    }

    // revisar suscriptores
    public $revisionSuscriptores;
    public function gestorRevisionSuscriptoresAjax() {
        $datos = $this->revisionSuscriptores;
        $respuesta = suscriptoresController::suscriptoresRevisadosController($datos);
        echo $respuesta;
    }
}

// objetos
if (isset($_POST["revisionMensajes"])) {
    $a = new Ajax();
    $a->revisionMensajes = $_POST["revisionMensajes"];
    $a->gestorRevisionMensajesAjax();
}

if (isset($_POST["revisionSuscriptores"])) {
    $b = new Ajax();
    $b->revisionSuscriptores = $_POST["revisionSuscriptores"];
    $b->gestorRevisionSuscriptoresAjax();
}
