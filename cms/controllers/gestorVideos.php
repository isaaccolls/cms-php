<?php

class Videos {
    public function seleccionarVideosController() {
        $respuesta = VideosModels::seleccionarVideosModel("videos");

        foreach ($respuesta as $row => $item) {
            echo '
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <video controls width="100%">
                        <source src="backend/' . substr($item["ruta"], 6) . '" type="video/mp4">
                    </video>
                </div>
            ';
        }
    }
}