<?php
    session_start();
    if (!$_SESSION["validar"]) {
        header("location:ingreso");
        exit();
    }
    include "views/modules/botonera.php";
    include "views/modules/cabezote.php";
?>
<!--=====================================
MENSAJES        
======================================-->
<div id="bandejaMensajes" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
  <div>
    <h1>Bandeja de Entrada</h1>
    <hr>
  </div>
  <?php
    $mostrarMensajes = new MensajesController();
    $mostrarMensajes -> mostrarMensajesController();
    $mostrarMensajes -> borrarMensajesController();
  ?>
</div>
<div id="lecturaMensajes" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
  <div>
    <hr>
    <button id="enviarCorreoMasivo" class="btn btn-success">Enviar mensaje a todos los usuarios</button>
    <hr>
  </div>
  <div id="visorMensajes">
    <?php
      $responderMensajes = new MensajesController();
      $responderMensajes -> responderMensajesController();
      $responderMensajes -> mensajesMasivosController();
    ?>
  </div>
</div>
<!--====  Fin de MENSAJES  ====-->