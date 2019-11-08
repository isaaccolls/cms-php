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

    // borrar articulos
    public function borrarArticuloModel($datosModel, $tabla) {
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "errror";
        }
        $stmt -> close();
    }

    // actualizar articulos
    public function editarArticuloModel($datosModel, $tabla) {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion, ruta = :ruta, contenido = :contenido WHERE id = :id");

        $stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
        $stmt -> bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error on model";
        }
        $stmt -> close();
    }

    // actualizar orden
    public function actualizarOrdenModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

        $stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_INT);
        $stmt -> bindParam(":id", $datos["ordenArticulos"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error, on model";
        }
        $stmt -> close();
    }

    // seleccionar orden
    public function seleccionarOrdenModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, titulo, introduccion, contenido FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }
}