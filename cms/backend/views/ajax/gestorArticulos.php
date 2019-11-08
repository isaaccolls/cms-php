<?php

require_once "../../controllers/gestorArticulos.php";
require_once "../../models/gestorArticulos.php";

// Clase y metodos
class Ajax {

    // subir la imagen del articulo 
    public $imagenTemporal;

    public function gestorArticulosAjax() {
        $datos = $this -> imagenTemporal;
        // echo $datos;
        $respuesta = GestorArticulos::mostrarImagenController($datos);
        echo $respuesta;
    }

    // actualizar orden
    public $actualizarOrdenArticulos;
    public $actualizarOrdenItem;
    public function actualizarOrdenAjax() {
        $datos = array(
            "ordenArticulos" => $this -> actualizarOrdenArticulos,
            "ordenItem" => $this -> actualizarOrdenItem
        );

        $respuesta = GestorArticulos::actualizarOrdenController($datos);
        echo $respuesta;
    }
}

//  Objetos
if (isset($_FILES["imagen"]["tmp_name"])) {
    $a = new Ajax();
    $a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $a -> gestorArticulosAjax();
}

if (isset($_POST["actualizarOrdenArticulos"])) {
    $b = new Ajax();
    $b -> actualizarOrdenArticulos = $_POST["actualizarOrdenArticulos"];
    $b -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
    $b -> actualizarOrdenAjax();
}