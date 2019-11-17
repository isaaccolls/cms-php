<?php

class MensajesModel {
    // registro mensajes
    public function registroMensajesModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre, email, mensaje) VALUES (:nombre, :email, :mensaje)");
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // registro suscriptores
    public function registroSuscriptoresModel($datos, $tabla) {
        $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla (nombre, email) VALUES (:nombre, :email)");
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);

        if ($stmt -> execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt -> close();
    }

    // validar suscriptor existente
    public function revisarSuscriptorModel($datosModel, $tabla) {
        $stmt = Conexion::conectar() -> prepare("SELECT email FROM $tabla WHERE email = :email");
        $stmt -> bindParam(":email", $datosModel, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();
    }

}