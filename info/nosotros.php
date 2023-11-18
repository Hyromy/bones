<?php
    $id_usuario = $_GET["user"];

    include_once("../db/connect.php");
    class DevDAO extends Connect {
        public function __construct() {
            parent::__construct();
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

    $postgres = new DevDAO;
    $user = $postgres->session($id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | DEEVEE</title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/info.css">
</head>
<body>
    <header>
        <article class="short">
            <img src="../media/img/bonesDino.png">
            <img class="imgSmall" src="../media/img/bonesTitle.png">
        </article>
        <article class="long">
            <ul>
                <li><a href="../principal/inicio.php?user=<?php echo $id_usuario;?>">INICIO</a></li>
                <li><a href="../menu/boletos.html">BOLETOS</a></li>
            </ul>
        </article>
        <article class="short">
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/defaultUser.png" title="Cerrar sesion para <?php echo $user["nombre_usuario"];?>"></a>
        </article>
    </header>
    <hr>
    <section class="info">
        <hr>
        <div class="spliter">Sobre Nosotros</div>
        <article>
            <h3>Objetivo de la empresa</h3>
            <p>Diseñar e implementar un gestor de visitas web a museos, siendo intuitivo, dinámico al usuario y funcionando como medio publicitario para los museos del Estado de México promoviendo las visitas presenciales.</p>
        </article>
        <hr>
        <div class="spliter">Desarrolladores</div>
        <article class="container">
            <div>
                <b>González Cruz Joel</b>
                <img src="pictures/joel.jpg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa ullam eligendi velit, labore optio modi incidunt nulla nihil assumenda, suscipit expedita rem temporibus molestias rerum, sequi quidem commodi? Quis, id.
            </div>
            <div>
                <b>Lopez Rodrigez Beatriz</b>
                <img src="pictures/betty.jpeg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa ullam eligendi velit, labore optio modi incidunt nulla nihil assumenda, suscipit expedita rem temporibus molestias rerum, sequi quidem commodi? Quis, id.
            </div>
            <div>
                <b>Martinez Gallegos Irving Iván</b>
                <img src="pictures/irving.jpeg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa ullam eligendi velit, labore optio modi incidunt nulla nihil assumenda, suscipit expedita rem temporibus molestias rerum, sequi quidem commodi? Quis, id.
            </div>
            <div>
                <b>Sanchez Razo Vanessa</b>
                <img src="pictures/vane.jpeg">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa ullam eligendi velit, labore optio modi incidunt nulla nihil assumenda, suscipit expedita rem temporibus molestias rerum, sequi quidem commodi? Quis, id.
            </div>
        </article>
    <hr>
    <footer>
        <div>
            <a href="">
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