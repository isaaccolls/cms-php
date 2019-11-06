<?php

require_once "conexion.php";

class GestorSlideModel {

    // Subir ruta de la imagen
    // ------------------------
    public function subirImagenSlideModel($datos, $tabla) {

        $stmt = Conexion::conectar() -> prepare("INSERT INTO `$tabla` (ruta) VALUES (:ruta)");

        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            // print_r($stmt -> errorInfo());
            return "error";
        }

        $stmt -> close();
    }

    // seleccionar la ruta de la imagen
    // ------------------------
    public function mostrarImagenSlideModel($datos, $tabla) {

        $stmt = Conexion::conectar() -> prepare("SELECT ruta, titulo, descripcion FROM $tabla WHERE ruta = :ruta");

        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

    }

    // mostrar imagenes en la vista
    // ------------------------
    public function mostrarImagenVistaModel($tabla) {

        $stmt = Conexion::conectar() -> prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();
    }

    // eliminar item del slide
    // ------------------------
    public function eliminarSlideModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("DELETE from $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos["idSlide"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();

    }

    // actualizar item del slide
    // ------------------------
    public function actualizarSlideModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion WHERE id = :id");

        $stmt -> bindParam(":titulo", $datos["enviarTitulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":descripcion", $datos["enviarDescripcion"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
    }

    // seleccionar item del slide
    // ------------------------
    public function seleccionarActualizacionSlideModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT titulo, descripcion FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();
    }

    // seleccionar item del slide
    // ------------------------
    public function actualizarOrdenModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

        $stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datos["ordenSlide"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt -> close();
    }

    // seleccionar orden
    // ------------------------
    public function seleccionarOrdenModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

    }
}