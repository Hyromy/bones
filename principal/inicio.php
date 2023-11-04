<?php

    $defaulLimit = 6;

    include_once("../db/connect.php");
    class MuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getMain($id) {
            $sql = "SELECT * from museo where id_museo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);

            $execute = $stmt->execute();
            $exists = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($execute && $exists) {
                $nombre = $exists["nombre"];
                $img_url = $exists["img_url"];
                $detalles = $exists["detalles"];

                $array = array($nombre, $img_url, $detalles);
            } else {
                $array ();
            }

            return $array;
        }

        public function sortBy($atribute, $order, $limit) {
            $sql = "SELECT id_museo from museo order by $atribute $order limit $limit;";

            $stmt = parent::get()->prepare($sql);
            $execute = $stmt->execute();
            $ids = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ids[] = $row['id_museo'];
            }
            
            return $ids;
        }
    }

    $posgres = new MuseoDAO;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | Inicio</title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../data/default.css">
    <link rel="stylesheet" href="../data/main.css">    
</head>
<body>
    <div id="inicio"></div>
    <header>
        <article class="short">
            <img src="../media/img/bonesDino.png">
            <img class="imgSmall" src="../media/img/bonesTitle.png">
        </article>
        <article class="long">
            <ul>
                <li><a href="#inicio">INICIO</a></li>
                <li><a href="../menu/boletos.html">BOLETOS</a></li>
            </ul>
        </article>
        <article class="short">
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/bones.ico"></a>
        </article>
    </header>
    <hr>
    <section class="main">
        <nav>
            <form class="src" action="" method="post">
                <img src="../media/img/buscar.png">
                <input name="nombre" type="text" placeholder="Buscar museos">
            </form>
        </nav>
        <hr>
        <div class="spliter">Museos populares</div>
        <article>
            <?php
                $ids;
                for ($i = 0; $i < 6; $i++) {
                    $ids = $posgres->sortBy("nombre", "asc", $defaulLimit);
                }
                foreach ($ids as $id) {
                    $museo = $posgres->getMain($id);
                    echo "  <div>
                                <h3>$museo[0]</h3>
                                <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                <p>$museo[2]</p>
                            </div>";
                }
            ?>
        </article>
        <hr>
        <div class="spliter">Recomendado para ti</div>
        <article>
                <?php
                    $ids;
                    for ($i = 0; $i < 6; $i++) {
                        $ids = $posgres->sortBy("id_museo", "asc", $defaulLimit);
                    }
                    foreach ($ids as $id) {
                        $museo = $posgres->getMain($id);
                        echo "  <div>
                                    <h3>$museo[0]</h3>
                                    <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                    <p>$museo[2]</p>
                                </div>";
                    }
                ?>
        </article>
        <hr>
        <div class="spliter">En tendencia</div>
        <article>
            <?php
                $ids;
                    for ($i = 0; $i < 6; $i++) {
                        $ids = $posgres->sortBy("visitas", "asc", $defaulLimit);
                    }
                    foreach ($ids as $id) {
                        $museo = $posgres->getMain($id);
                        echo "  <div>
                                    <h3>$museo[0]</h3>
                                    <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                    <p>$museo[2]</p>
                                </div>";
                    }
                ?>
        </article>
    </section>
    <hr>
    <footer>
        <div>
            <a href="">
                <img src="../media/img/deevee.ico">
                <br>Sobre Nosotros
            </a>
        </div>
        <div>
            <a href="">
                <img src="../media/img/bonesDino.png">
                <br>Sobre BONES
            </a>
        </div>
    </footer>
</body>
</html>