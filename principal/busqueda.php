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
            $execute = $stmt->execute();
            
            $museo = $stmt->fetch(PDO::FETCH_ASSOC);
               
            if ($execute && $museo) {
                return $museo;
            } else {

                $museo = array("id_museo" => 0,
                                "nombre" => "Sin resultados");
                
                return $museo;
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
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/bones.ico"></a>
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
            if ($museo["id_museo"] != 0) {
                //Falta operar más de un resultado si es que existen


                echo "<h2>Resutados de busqueda para " . $busqueda . "</h2>";
                
                echo "ID de busqueda: " . $museo["id_museo"] . "<br>";
                echo "Nombre de busqueda: " . $museo["nombre"] . "<br>";
                echo "Categorias de busqueda: " . $museo["categoria"] . "<br>";

                echo "<hr>";

                    
            } else {
                echo "  <div class='notFound'>
                            <h2>No hay resultados de busqueda para $busqueda</h2>
                            <img src='../media/img/qiqi_fallen.png'>
                            <p>No encontré nada, quizá quieres algo que solo tus pensamientos pueden imaginar</p>
                        </div>";
            }
        ?>

        <div class="result">
            <article class="short">
                <img class="picture" src="../media/img/backgrundAccess.jpeg">
            </article>
            <article class="long">
                <h2>Nombre Museo</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, temporibus laboriosam recusandae asperiores architecto eum qui, perspiciatis ipsam ab incidunt ex itaque omnis nesciunt aperiam dolorum enim illo, corrupti tempore.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium, quod cupiditate voluptatem facilis iste nobis quaerat laboriosam blanditiis doloremque assumenda officiis cumque suscipit eveniet excepturi porro doloribus dolor voluptas eos.</p>
            </article>
            <article class="short">
                <!-- <form> -->
                    <button class="send" type="submit">Ver Museo</button>
                <!-- </form> -->
            </article>        
        </div>


        
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