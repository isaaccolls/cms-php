<?php
    
    class SlideModels {

        public function seleccionarSlideModel($tabla) {

            $stmt = Conexion::conectar() -> prepare("SELECT ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

            $stmt -> execute();

            return $stmt -> fetchAll();

            $stmt -> close();
        }
    }