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
VIDEOS ADMINISTRABLE          
======================================-->
<div id="videos" class="col-lg-10 col-md-10 col-sm-9 col-xs-12">
    <form method="post" enctype="multipart/form-data">
        <input type="file" id="subirVideo" name="video" class="btn btn-default" required>
    </form>
    <p>Subir solo videos en formato MP4 y que no mayor a 50MB</p>
    <ul id="galeriaVideo">
        <?php
            $video = new GestorVideos();
            $video -> mostrarVideoVistaController();
        ?>
    </ul>
    <button class="btn btn-warning " style="margin:10px 30px;">Ordenar Videos</button>
</div>
