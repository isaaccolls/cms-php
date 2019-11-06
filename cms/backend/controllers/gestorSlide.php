<?php

class GestorSlide {

    // mostrar imagen slide con Ajax
    // ------------------------
    public function mostrarImagenController($datos) {

        // var_dump(getimagesize($datos["imagenTemporal"]));
        // list: (no es una funcion, es un constructor del lenguaje) Se utiliza para asignar una lista de variables en una sola operacion
        list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);
        // echo $ancho;
        // echo $alto;

        if ($ancho < 1600 || $alto < 600) {
            echo 0;
        } else {
            $aleatorio = mt_rand(100, 999);
            $ruta = "../../views/images/slide/slide".$aleatorio.".jpg";
            // echo $ruta;
            // imagecreatefromjpeg: crea una nueva imagen a partir de un fichero o de una URL
            $origen = imagecreatefromjpeg($datos["imagenTemporal"]);
            // imagecrop: recorta una imagen usando las coordenadas, tamaño, x, y, ancho y alto dados
            $destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 1600, "height" => 600]);
            // imagejpeg: exporta imagen al navegador o a un fichero
            imagejpeg($destino, $ruta);
            // echo 1;
            GestorSlideModel::subirImagenSlideModel($ruta, "slide");

            //
            $respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta, "slide");
            $enviarDatos = array(
                "ruta" => $respuesta["ruta"],
                "titulo" => $respuesta["titulo"],
                "descripcion" => $respuesta["descripcion"]
            );
            echo json_encode($enviarDatos);
        }

    }

    // mostrar imagenes en la vista
    // ------------------------
    public function mostrarImagenVistaController() {
        $respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

        foreach ($respuesta as $fila => $item) {
            echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span><img src="'.substr($item["ruta"], 6).'" class="handleImg"></li>';
        }
    }

    // mostrar imagenes en el editor
    // ------------------------
    public function editorSlideController() {
        $respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

        foreach ($respuesta as $fila => $item) {
            echo '<li id="item'.$item["id"].'">
                    <span class="fa fa-pencil editarSlide" style="background:blue"></span>
                    <img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
                    <h1>'.$item["titulo"].'</h1>
                    <p>'.$item["descripcion"].'</p>
                 </li>';
        }
    }

    // eliminar item del slide
    // ------------------------
    public function eliminarSlideController($datos) {
        GestorSlideModel::eliminarSlideModel($datos, "slide");

        unlink($datos["rutaSlide"]);

        // echo $respuesta;
    }

    // actualizar item del slide
    // ------------------------
    public function actualizarSlideController($datos) {
        // $respuesta = GestorSlideModel::actualizarSlideModel($datos, "slide");
        // echo $respuesta;
        GestorSlideModel::actualizarSlideModel($datos, "slide");
        $respuesta = GestorSlideModel::seleccionarActualizacionSlideModel($datos, "slide");

        $enviarDatos = array(
            "titulo" => $respuesta["titulo"],
            "descripcion" => $respuesta["descripcion"]
        );
        echo json_encode($enviarDatos);
    }

    // actualizar orden
    // ------------------------
    public function actualizarOrdenController($datos) {
        GestorSlideModel::actualizarOrdenModel($datos, "slide");

        $respuesta = GestorSlideModel::seleccionarOrdenModel("slide");

        foreach($respuesta as $row => $item) {
            echo '<li id="item'.$item["id"].'">
                    <span class="fa fa-pencil editarSlide" style="background:blue"></span>
                    <img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
                    <h1>'.$item["titulo"].'</h1>
                    <p>'.$item["descripcion"].'</p>
                 </li>';
        }
    }
}