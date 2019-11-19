<?php

require_once "conexion.php";

class GestorPerfilesModel {
    // guardar pefil
    public function guardarPerfilModel($datosModel, $tabla) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email, photo, rol) values (:usuario, :password, :email, :photo, :rol)");
        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":photo", $datosModel["photo"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $datosModel["rol"], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
    }

    // visualizar perfiles
    public function verPerfilesModel($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email, photo, rol FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll();
        $stmt->close();
    }
}