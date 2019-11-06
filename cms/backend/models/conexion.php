<?php

class Conexion {

    public function conectar() {

        $link = new PDO("mysql:host=mysql:3306;dbname=cms", "root", "cms420");
        return $link;
    }
}