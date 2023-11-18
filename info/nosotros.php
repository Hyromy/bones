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
            </ul>
        </article>
        <article class="short">
            <a href="../"><img class="imgSmall" src="../media/img/defaultUser.png" title="Cerrar sesion para <?php echo $user["nombre_usuario"];?>"></a>
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
                <small>TSU en Desarrollo de software multiplataforma</small>
                <img src="pictures/joel.jpg">
                <p>Joven apasionado por la tecnologia, las ciencias y la experimentación. Busca conotribuir a la sociedad con herramientas utiles a largo plazo, así mismo desea que estas prevelezcan y se mejoren a travez del paso del tiempo.</p>
                <p><a href="https://discord.com/users/608870766586494976" target="_blanck"><img src="social/discord.ico"> Discord</a></p>
                <p><a href="https://github.com/Hyromy" target="_blanck"><img src="social/git.ico"> Github</a></p>
                <p><a href="mailto:formulajoel9@gmail.com" target="_blanck"><img src="social/gmail.ico"> Correo</a></p>
            </div>
            <div>
                <b>Lopez Rodrigez Beatriz</b>
                <small>TSU en Desarrollo de software multiplataforma</small>
                <img src="pictures/betty.jpeg">
                <p></p>
                <p><a href="https://www.facebook.com/betybbu?mibextid=ZbWKwL" target="_blanck"><img src="social/facebook.ico"> Facebook</a></p>
                <p><a href="https://www.instagram.com/bettylopezrodriguez18/?igshid=MzMyNGUyNmU2YQ%3D%3D" target="_blanck"><img src="social/instagram.ico"> Instagram</a></p>
                <p><a href="mailto:2523260008blopezr@gmail.com" target="_blanck"><img src="social/gmail.ico"> Correo</a></p>
            </div>
            <div>
                <b>Sanchez Razo Vanessa</b>
                <small>TSU en Desarrollo de software multiplataforma</small>
                <img src="pictures/vane.jpeg">
                <p>Estudiante del Área de Desarrollo de Software Multiplataforma, buscando dar el apoyo a la sociedad por medio de una página web para más conocimiento de museos</p>
                <p><a href="https://www.facebook.com/profile.php?id=100014421766426&mibextid=ZbWKwL" target="_blanck"><img src="social/facebook.ico"> Facebook</a></p>
                <p><a href="https://instagram.com/vane_razosan?igshid=MTNiYzNiMzkwZA==" target="_blanck"><img src="social/instagram.ico"> Instagram</a></p>
                <p><a href="https://www.tiktok.com/@ff_vanerazo0?_t=8hTP58ZD5cs&_r=1" target="_blanck"><img src="social/tiktok.ico"> TikTok</a></p>
                <p><a href="mailto:vanessa.r05112004@gmail.com" target="_blanck"><img src="social/gmail.ico"> Correo</a></p>
            </div>
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