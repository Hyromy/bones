<?php
    $busqueda = $_GET["busqueda"];
    for ($i = 0; $i < strlen($busqueda); $i++) {
        if ($i == 0) {
            $busqueda[$i] = strtoupper($busqueda[$i]);
        } else {
            $busqueda[$i] = strtolower($busqueda[$i]);
        }
    }

    include_once("../db/connect.php");
    class MuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getMuseo($busqueda) {
            $sql = "SELECT * from museo where nombre like '%$busqueda%';";

            $stmt = parent::get()->prepare($sql);
            $execute = $stmt->execute();
            $museo = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($execute && $museo) {
                return $museo;
            } else {
                echo "<h2>Ocurrio un problema</h2>";
            }
        }
    }

    $postgres = new MuseoDAO;
    $museo = $postgres->getMuseo($busqueda);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | <?php echo $museo["nombre"];?></title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../styles/default.css">
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
    <section>
        <?php
            echo "ID de busqueda: " . $museo["id_museo"] . "<br>";
            echo "Nombre de busqueda: " . $museo["nombre"] . "<br>";
            echo "Categorias de busqueda: " . $museo["categoria"] . "<br>";
        ?>
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