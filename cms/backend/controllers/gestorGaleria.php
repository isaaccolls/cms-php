<?php

class GestorGaleria {
    // mostrar imagen galeria (from ajax)
    public function mostrarImagenController($datos) {
        list($ancho, $alto) = getimagesize($datos);
        if ($ancho < 1024 || $alto < 768) {
            echo 0;
        } else {
            $aleatorio = mt_rand(100, 999);
            $ruta = "../../views/images/galeria/galeria".$aleatorio.".jpg";
            $nuevo_ancho = 1024;
            $nuevo_alto = 768;
            $origen = imagecreatefromjpeg($datos);
            // 
            $destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
            // copia una porcion de una imagen a otra
            // rezise 👽
            // bool imagecopyresized ($destino, $origen, int $destino_x, int $destino_y, int $origen_x, int $origen_y, int $destino_w, int $destino_h, int $origen_w, int $origen_h)
            imagecopyresized ($destino, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $alto, $ancho);
            imagejpeg($destino, $ruta);

            GestorGaleriaModel::subirImagenGaleriaModel($ruta, "galeria");
            $respuesta = GestorGaleriaModel::mostrarImagenGaleriaModel($ruta, "galeria");

            echo $respuesta["ruta"];
        }
    }

    // mostrar imagen en la vista
    public function mostrarImagenVistaController() {
        $respuesta = GestorGaleriaModel::mostrarImagenVistaModel("galeria");

        foreach ($respuesta as $row => $item) {
            echo '
                <li id="'.$item["id"].'"">
                    <span class="fa fa-times eliminarFoto" ruta="' . $item["ruta"] . '"></span>
                    <a rel="grupo" href="'.substr($item["ruta"], 6).'">
                    <img src="' . substr($item["ruta"], 6) . '">
                    </a>
                </li>
            ';
        }
    }

    // eliminar item de galeria
    public function eliminarGaleriaController($datos) {
        $repuesta = GestorGaleriaModel::eliminarGaleriaModel($datos, "galeria");
        error_log("WTF!");
        error_log(print_r($datos["rutaGaleria"], true));
        unlink($datos["rutaGaleria"]);
        echo $repuesta;
    }
}
