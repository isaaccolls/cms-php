<?php

require_once "conexion.php";

class GestorVideosModel {

    // subir ruta del video
    public function subirVideoModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");
        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // seleccionar ruta del video
    public function mostrarVideoModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");
        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
    }

    // mostrar videos en la vista
    public function mostrarVideoVistaModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }

    // eliminar video
    public function eliminarVideoModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $datos["idVideo"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // actualizar orden
    public function actualizarOrdenModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");
        $stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_INT);
        $stmt -> bindParam(":id", $datos["ordenVideo"], PDO::PARAM_INT);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // seleccionar orden
    public function seleccionarOrdenModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");
        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }
}