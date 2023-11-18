<?php
    $id_usuario = $_POST["user"];
    $busqueda = $_POST["busqueda"];
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

        public function session($id_usuario) {
            $sql = "SELECT * from usuario where id_usuario=?;";
            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id_usuario);
            $stmt->execute();
            $user = $stmt->fetch(); 

            return $user;
        }
    }

    $postgres = new MuseoDAO;
    $museos = $postgres->getMuseo($busqueda);
    $user = $postgres->session($id_usuario);
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
                <li><a href="inicio.php?user=<?php echo $id_usuario?>">INICIO</a></li>
            </ul>
        </article>
        <article class="short">
            <a href="../"><img class="imgSmall" src="../media/img/defaultUser.png" title="Cerrar sesion para <?php echo $user["nombre_usuario"];?>"></a>
        </article>
    </header>
    <hr>
    <section class="list">
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

        <?php
            if (count($museos) > 0) {
                echo "<h2>Resutados de busqueda para " . $busqueda . "</h2>";
                $i = 0;
                foreach ($museos as $museo) {
                    echo "  <div class='result i$i'>
                                <style>
                                    .i$i{
                                        background-image: linear-gradient(to left, transparent , #000 33.33%), url('../media/temp/" . $museo->img_name . "');
                                    }
                                </style>
                                <article class='short'>
                                    <img class='picture' src='../media/temp/" . $museo->img_name . "' alt='Imagen del museo'>
                                </article>
                                <article class='long'>
                                    <h2>" . $museo->nombre . "</h2>
                                    <p>" . $museo->about . "</p>
                                </article>
                                <article class='short'>
                                    <form action='museo.php' method='post'>
                                        <input class='hidden' type='number' name='user' value='" . $user["id_usuario"] . "'>
                                        <input class='hidden' type='text' name='nombre' value='" . $museo->nombre . "'>
                                        <button class='send' type='submit'>Ver Museo</button>
                                    </form>
                              </article>        
                            </div>";
                    $i++;
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
    </footer>
</body>
</html>