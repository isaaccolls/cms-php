<?php
require_once "../../models/gestorSlide.php";
require_once "../../controllers/gestorSlide.php";

// CLASE Y METODOS
// ------------------------

class Ajax {

    // Subir imagen slide
    // ------------------------
    public $nombreImagen;
    public $imagenTemporal;

    public function gestorSlideAjax() {
        $datos = array(
            "nombreImagen" => $this -> nombreImagen,
            "imagenTemporal" => $this -> imagenTemporal
        );

        $respuesta = GestorSlide::mostrarImagenController($datos);

        echo $respuesta;
    }

    // Eliminar item slide
    // ------------------------
    public $idSlide;
    public $rutaSlide;

    public function eliminarSlideAjax() {
        $datos = array(
            "idSlide" => $this -> idSlide,
            "rutaSlide" => $this -> rutaSlide
        );
        $respuesta = GestorSlide::eliminarSlideController($datos);
        echo $respuesta;
    }

    // Eliminar item slide
    // ------------------------
    public $enviarId;
    public $enviarTitulo;
    public $enviarDescripcion;

    public function actualizarSlideAjax() {
        $datos = array(
            "enviarId" => $this -> enviarId,
            "enviarTitulo" => $this -> enviarTitulo,
            "enviarDescripcion" => $this -> enviarDescripcion,
        );

        $respuesta = GestorSlide::actualizarSlideController($datos);
        echo $respuesta;
    }

    // Actualizar Orden
    // ------------------------
    public $actualizarOrdenSlide;
    public $actualizarOrdenItem;

    public function actualizarOrdenAjax() {
        $datos = array(
            "ordenSlide" => $this -> actualizarOrdenSlide,
            "ordenItem" => $this -> actualizarOrdenItem
        );

        $respuesta = GestorSlide::actualizarOrdenController($datos);
    }
}

// OBJETOS
// ------------------------
if (isset($_FILES["imagen"]["name"])) {
    $a = new Ajax();
    $a -> nombreImagen = $_FILES["imagen"]["name"];
    $a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $a -> gestorSlideAjax();
}

if (isset($_POST["idSlide"])) {
    $b = new Ajax();
    $b -> idSlide = $_POST["idSlide"];
    $b -> rutaSlide = $_POST["rutaSlide"];
    $b -> eliminarSlideAjax();
}

if (isset($_POST["enviarId"])) {
    $c = new Ajax();
    $c -> enviarId = $_POST["enviarId"];
    $c -> enviarTitulo = $_POST["enviarTitulo"];
    $c -> enviarDescripcion = $_POST["enviarDescripcion"];
    $c -> actualizarSlideAjax();
}

if (isset($_POST["actualizarOrdenSlide"])) {
    $d = new Ajax();
    $d -> actualizarOrdenSlide = $_POST["actualizarOrdenSlide"];
    $d -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $d -> actualizarOrdenAjax();
}