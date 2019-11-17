<?php

require_once "models/ingreso.php";
require_once "models/enlaces.php";
require_once "models/gestorSlide.php";
require_once "models/gestorArticulos.php";
require_once "models/gestorGaleria.php";
require_once "controllers/gestorGaleria.php";
require_once "controllers/gestorVideos.php";
require_once "controllers/gestorMensajes.php";

require_once "controllers/template.php";
require_once "controllers/ingreso.php";
require_once "controllers/enlaces.php";
require_once "controllers/gestorSlide.php";
require_once "controllers/gestorArticulos.php";
require_once "models/gestorGaleria.php";
require_once "models/gestorVideos.php";
require_once "models/gestorMensajes.php";


$template = new TemplateController();
$template -> template();