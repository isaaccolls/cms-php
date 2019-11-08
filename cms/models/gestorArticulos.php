<?php

require_once "backend/models/conexion.php";

class ArticulosModels {

    public function seleccionarArticulosModel($tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT id, titulo, introduccion, contenido, ruta FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();
        return $stmt -> fetchAll();
        $stmt -> close();
    }
}