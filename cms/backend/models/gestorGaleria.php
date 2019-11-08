<?php

require_once "conexion.php";

class GestorGaleriaModel {

    // subir imagen de galeria
    public function subirImagenGaleriaModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");

        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // se;eccionar ruta de la imagen
    public function mostrarImagenGaleriaModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");

        $stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
    }

    // mostrar imagen en la vista
    public function mostrarImagenVistaModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }

    // eliminar item galeria
    public function eliminarGaleriaModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam(":id", $datos["idGaleria"], PDO::PARAM_INT);
        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }
}
