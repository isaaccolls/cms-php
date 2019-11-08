<?php

class Galeria {
    public function seleccionarGaleriaController() {
        $respuesta = GaleriaModels::seleccionarGaleriaModel("galeria");

        foreach ($respuesta as $row => $item) {
            echo '
                <li>
                    <a rel="grupo" href="backend/' . substr($item["ruta"], 6) . '">
                        <img src="backend/' . substr($item["ruta"], 6) . '">
                    </a>
                </li>
            ';
        }
    }

}
