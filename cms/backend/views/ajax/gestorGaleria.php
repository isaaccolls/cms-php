<?php

require_once "../../controllers/gestorGaleria.php";
require_once "../../models/gestorGaleria.php";

// clase y metodos
class Ajax {

    // subir imagen de la galeria
    public $imagenTemporal;
    public function gestorGaleriaAjax() {
        $datos = $this -> imagenTemporal;
        $respuesta = GestorGaleria::mostrarImagenController($datos);
        echo $respuesta;
    }

    // elimiar item galeria
    public $idGaleria;
    public $rutaGaleria;
    public function eliminarGaleriaAjax() {
        $datos = array(
            "idGaleria" => $this -> idGaleria,
            "rutaGaleria" => $this -> rutaGaleria
        );
        $respuesta = GestorGaleria::eliminarGaleriaController($datos);
        echo $respuesta;
    }

    // actualizar orden
    public $actualizarOrdenGaleria;
    public $actualizarOrdenItem;
    public function actualizarOrdenAjax() {
        $datos = array(
            "ordenGaleria" => $this -> actualizarOrdenGaleria,
            "ordenItem" => $this -> actualizarOrdenItem
        );
        $respuesta = GestorGaleria::actualizarOrdenController($datos);
        echo $respuesta;
    }
}

// objetos
if (isset($_FILES["imagen"]["tmp_name"])) {
    $a = new Ajax();
    $a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $a -> gestorGaleriaAjax();
}

if (isset($_POST["idGaleria"])) {
    $b = new Ajax();
    $b -> idGaleria = $_POST["idGaleria"];
    $b -> rutaGaleria = $_POST["rutaGaleria"];
    $b -> eliminarGaleriaAjax();
}

if (isset($_POST["actualizarOrdenGaleria"])) {
    $c = new Ajax();
    $c -> actualizarOrdenGaleria = $_POST["actualizarOrdenGaleria"];
    $c -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $c -> actualizarOrdenAjax();
}
