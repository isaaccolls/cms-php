<?php

require_once "../../controllers/gestorArticulos.php";

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
}

//  Objetos
if (isset($_FILES["imagen"]["tmp_name"])) {
    $a = new Ajax();
    $a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
    $a -> gestorArticulosAjax();
}