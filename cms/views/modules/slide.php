<div class="row">
    <div id="slide" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <ul>
            <?php
                $slide = new Slide();
                $slide -> seleccionarSlideController();
            ?>
        </ul>
        <ol id="indicadores">
            <!-- <li role-slide = "1"><span class="fa fa-circle"></span></li>
            <li role-slide = "2"><span class="fa fa-circle"></span></li>
            <li role-slide = "3"><span class="fa fa-circle"></span></li>
            <li role-slide = "4"><span class="fa fa-circle"></span></li> -->
        </ol>
        <div id="slideIzq"><span class="fa fa-chevron-left"></span></div>
        <div id="slideDer"><span class="fa fa-chevron-right"></span></div>
    </div>
</div>