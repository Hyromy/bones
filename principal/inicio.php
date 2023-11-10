<?php
    $defaulLimit = 6;

    include_once("../db/connect.php");
    class MainDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getMain($id) {
            $sql = "SELECT * from museo where id_museo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);
            
            if ($stmt->execute()) {
                $museo = $stmt->fetch();
                return $museo;
            }
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

    $posgres = new MainDAO;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | Inicio</title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/nav.css">
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
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/defaultUser.png"></a>
        </article>
    </header>
    <hr>
    <section class="main">
        <nav>
            <form class="src" action="busqueda.php" method="get">
                <img src="../media/img/buscar.png">
                <input name="busqueda" type="text" placeholder="Buscar museos">
            </form>
        </nav>
        <hr>
        <div class="spliter">Para ti</div>
        <article>
            <?php
                $consulta = $posgres->sortBy("nombre", "asc", $defaulLimit);
                foreach ($consulta as $id) {
                    $museo = $posgres->getMain($id);
                    echo "  <div>
                                    <form action='museo.php' method='post'>
                                        <h3>" . $museo["nombre"] . "</h3>
                                        <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input type='text' name='nombre' value='" . $museo["nombre"] . "'>
                                        <button type='submmit'>Ver Museo</button>
                                    </form>
                                </div>";
                }
            ?>
        </article>
        <hr>
        <div class="spliter">Más visitados</div>
        <article>
            <?php
                $consulta = $posgres->sortBy("visitas", "desc", $defaulLimit);
                foreach ($consulta as $id) {
                    $museo = $posgres->getMain($id);
                    echo "  <div>
                                    <form action='museo.php' method='post'>
                                        <h3>" . $museo["nombre"] . "</h3>
                                        <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input type='text' name='nombre' value='" . $museo["nombre"] . "'>
                                        <button type='submmit'>Ver Museo</button>
                                    </form>
                                </div>";
                }
            ?>
        </article>
        <hr>
        <div class="spliter">Mejor puntuados</div>
        <article>
            <?php
                $consulta = $posgres->sortBy("puntuacion", "desc", $defaulLimit);
                foreach ($consulta as $id) {
                    $museo = $posgres->getMain($id);
                    echo "  <div>
                                    <form action='museo.php' method='post'>
                                        <h3>" . $museo["nombre"] . "</h3>
                                        <img src='../media/img/backgrundAccess.jpeg' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input type='text' name='nombre' value='" . $museo["nombre"] . "'>
                                        <button type='submmit'>Ver Museo</button>
                                    </form>
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