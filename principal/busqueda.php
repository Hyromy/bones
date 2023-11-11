<?php
    $busqueda = $_GET["busqueda"];
    $busqueda = ucfirst(strtolower($busqueda));

    include_once("../db/connect.php");
    class MuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getMuseo($busqueda) {
            $sql = "SELECT * from museo where nombre like '%$busqueda%';";
            $stmt = parent::get()->prepare($sql);
            $stmt->execute();
            $museos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $museos;
        }
    }

    $postgres = new MuseoDAO;
    $museos = $postgres->getMuseo($busqueda);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | Busqueda</title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/list.css">
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
                <li><a href="inicio.php">INICIO</a></li>
                <li><a href="../menu/boletos.html">BOLETOS</a></li>
            </ul>
        </article>
        <article class="short">
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/defaultUser.png"></a>
        </article>
    </header>
    <hr>
    <section class="list">
        <nav>
            <form class="src" action="busqueda.php" method="get">
                <img src="../media/img/buscar.png">
                <input name="busqueda" type="text" placeholder="Buscar museos">
            </form>
        </nav>

        <?php
            if (count($museos) > 0) {
                echo "<h2>Resutados de busqueda para " . $busqueda . "</h2>";
                foreach ($museos as $museo) {
                    echo "  <div class='result'>
                                <article class='short'>
                                    <img class='picture' src='../media/img/backgrundAccess.jpeg'>
                                </article>
                                <article class='long'>
                                    <h2>" . $museo->nombre . "</h2>
                                    <p>" . $museo->about . "</p>
                                </article>
                                <article class='short'>
                                    <form action='museo.php' method='post'>
                                        <input type='text' name='nombre' value='" . $museo->nombre . "'>
                                        <button class='send' type='submit'>Ver Museo</button>
                                    </form>
                              </article>        
                            </div>";
                }
            } else {
                echo "  <div class='notFound'>
                            <h2>No hay resultados de busqueda para " . $busqueda . "</h2>
                            <img src='../media/img/qiqi_fallen.png'>
                            <p>No encontré nada, quizá quieres algo que solo tus pensamientos pueden imaginar</p>
                        </div>";
            }
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