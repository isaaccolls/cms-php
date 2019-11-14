<?php

require_once "../../models/gestorVideos.php";
require_once "../../controllers/gestorVideos.php";

// clases y metodos
class Ajax {
    // subir video
    public $videoTemporal;

    public function gestorVideoAjax() {
        $datos = $this -> videoTemporal;
        $respuesta = GestorVideos::mostrarVideoController($datos);
        echo $respuesta;
    }

    // eliminar item video
    public $idVideo;
    public $rutaVideo;
    public function eliminarVideoAjax() {
        $datos = array(
            "idVideo" => $this -> idVideo,
            "rutaVideo" => $this -> rutaVideo
        );
        $respuesta = GestorVideos::eliminarVideoController($datos);
        echo $respuesta;
    }
}

// objetos
if (isset($_FILES["video"]["tmp_name"])) {
    $a = new Ajax();
    $a -> videoTemporal = $_FILES["video"]["tmp_name"];
    $a -> gestorVideoAjax();
}

if (isset($_POST["idVideo"])) {
    $b = new Ajax();
    $b -> idVideo = $_POST["idVideo"];
    $b -> rutaVideo = $_POST["rutaVideo"];
    $b -> eliminarVideoAjax();
}