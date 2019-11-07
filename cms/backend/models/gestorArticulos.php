<?php

require_once "conexion.php";

class GestorArticulosModel {

    // guardar articulo
    public function guardarArticuloModel($datosModel, $tabla) {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (titulo, introduccion, ruta, contenido) VALUES  (:titulo, :introduccion, :ruta, :contenido)");

        $stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
        $stmt -> bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
    }

    // mostrar articulos
    public function mostrarArticulosModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }
}