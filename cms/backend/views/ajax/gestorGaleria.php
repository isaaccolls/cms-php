<?php

require_once "../../controllers/gestorGaleria.php";
require_once "../../models/gestorGaleria.php";

// clase y metodos
class Ajax {
    public $imagenTemporal;

    public function gestorGaleriaAjax() {
        $datos = $this -> imagenTemporal;
        $respuesta = GestorGaleria::mostrarImagenController($datos);
        echo $respuesta;
    }
}

// objetos
if (isset($_FILES["imagen"]["tmp_name"])) {
    $a = new Ajax();
    $a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $a -> gestorGaleriaAjax();
}