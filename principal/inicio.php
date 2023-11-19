<?php
    $defaulLimit = 6;
    $id_usuario = $_GET["user"];

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

        public function session($id_usuario) {
            $sql = "SELECT * from usuario where id_usuario=?;";
            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id_usuario);
            $stmt->execute();
            $user = $stmt->fetch(); 

            return $user;
        }
    }

    $posgres = new MainDAO;
    $user = $posgres->session($id_usuario);
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
            </ul>
        </article>
        <article class="short">
            <a href="../"><img class="imgSmall" src="../media/img/defaultUser.png" title="Cerrar sesion para <?php echo $user["nombre_usuario"];?>"></a>
        </article>
    </header>
    <hr>
    <section class="main">
        <nav>
            <form class="src" id="nav" action="busqueda.php" method="post">
                <img src="../media/img/buscar.png">
                <input class="hidden" type="numer" name="user" value="<?php echo $user["id_usuario"];?>">
                <input name="busqueda" type="text" placeholder="Buscar museos">
            </form>
            <script>
                document.addEventListener("keypress", function (x) {
                    if (x.keyCode == 13 && x.target.type === "text") {
                        x.preventDefault();
                        document.querySelector("#nav").submit();
                    }
                })
            </script>
        </nav>
        <div class="banner">
            <h1>Museos</h1>
            <video src="../media/vid/banner.mp4" muted autoplay loop></video>
        </div>
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
                                        <img src='../media/temp/" . $museo["img_name"] . "' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input class='hidden' type='number' name='user' value='" . $user["id_usuario"] . "'>
                                        <input class='hidden' type='text' name='nombre' value='" . $museo["nombre"] . "'>
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
                                        <img src='../media/temp/" . $museo["img_name"] . "' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input class='hidden' type='number' name='user' value='" . $user["id_usuario"] . "'>
                                        <input class='hidden' type='text' name='nombre' value='" . $museo["nombre"] . "'>
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
                                        <img src='../media/temp/" . $museo["img_name"] . "' alt='Imagen del museo'>
                                        <p>" . $museo["sinopsis"] . "</p>
                                        <p><b>" . $museo["categoria"] . "</b></p>
                                        <input class='hidden' type='number' name='user' value='" . $user["id_usuario"] . "'>
                                        <input class='hidden' type='text' name='nombre' value='" . $museo["nombre"] . "'>
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
            <a href="../info/nosotros.php?user=<?php echo $id_usuario?>">
                <img src="../media/img/deevee.ico">
                <br>Sobre Nosotros
            </a>
        </div>
        <div>
            <a href="../info/project.php?user=<?php echo $id_usuario?>">
                <img src="../media/img/bonesDino.png">
                <br>Sobre BONES
            </a>
        </div>
        <div>
            <a href="https://github.com/Hyromy/bones" target="_blanck">
                <img src="../media/img/github.ico">
                <br>Ver repositorio
            </a>
        </div>
    </footer>
</body>
</html>