<?php
    $nombre = $_POST["nombre"];
    $id_usuario = $_POST["user"];

    include_once("../db/connect.php");
    class DataDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getData($nombre) {
            $sql = "SELECT * from museo where nombre=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $nombre);

            if ($stmt->execute()) {
                $museo = $stmt->fetch();
                return $museo;
            }
        }

        public function drawStar($amount) {
            $img = "";
            $x = 0;
            for ($i = 1; $i <= $amount; $i++) {
                $img = $img . "<img src='../media/img/star.png'>";
                $x++;
            }
            if (($amount - $x) != 0) {
                $img = $img . "<img src='../media/img/starHalf.png'>";
            }

            return $img;
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

    $postgres = new DataDAO;
    $museo = $postgres->getData($nombre);
    $img = $postgres->drawStar($museo["puntuacion"]);
    $user = $postgres->session($id_usuario);
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | <?php echo $museo["nombre"];?></title>
    <link rel="shorcut icon" href="../media/img/bones.ico">
    <link rel="stylesheet" href="../styles/default.css">
    <link rel="stylesheet" href="../styles/museo.css">
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
    <section class="container">
        <article class="museo">
            <div class="face">
                <div class="topic"><img src="../media/temp/<?php echo $museo["img_name"];?>"></div>
                <div class="topic r">
                    <h2><?php echo $museo["nombre"];?></h2>
                    <p><b>Descripción</b> <?php echo $museo["sinopsis"];?></p>
                    <p><b>Categorias</b> <?php echo $museo["categoria"];?></p>
                    <p><b>Puntuación</b> <?php echo $museo["puntuacion"] . " " .$img;?></p>
                    <p><b>Visitas totales</b> <?php echo $museo["visitas"];?></p>
                </div>
            </div>
            <hr>
            <div class="bottom">
                <div class="address">
                    <p><b>Entidad federativa: </b><?php echo $museo["estado"];?></p>
                    <p><b>Colonia: </b><?php echo $museo["colonia"];?></p>
                    <p><b>Calle: </b><?php echo $museo["calle"];?></p>
                    <?php if ($museo["detalles"] != 0) {echo "<p><b>Detalles de la dirección: </b>" . $museo["detalles"];}?>
                    <?php if ($museo["map_url"] != 0) {echo "<p><a href='" . $museo["map_url"] . "' target='_blanck'><img src='../media/img/link.png'> Ver en el mapa</a></p>";}?>
                    <?php if ($museo["address_url"] != 0) {echo "<p><a href='" . $museo["address_url"] . "' target='_blanck'><img src='../media/img/link.png'> Página oficial de '" . $museo["nombre"] . "'</a></p>";}?>
                </div>
                <div class="data">
                    <h3>Datos generales</h3>
                    <p><?php echo $museo["about"];?></p>
                </div>
            </div>
        </article>
        <article class="buyZone">
            <h2>Comprar boletos para <?php echo $museo["nombre"];?></h2>
            <p>Selecciona fecha para escoger tus boletos</p>
            <form action="museo.php" method="post">
                <div>
                    <label>Dia de la visita</label><input type="date" required>
                    <input class="hidden" type="text" name="nombre" value="<?php echo $museo["nombre"];?>">
                    <input class="hidden" type="text" name="user" value="<?php echo $user["id_usuario"];?>">
                    <button type="submmit">Comprar</button>
                </div>
                <div>
                    <label>Cantidad de boletos</label><input type="number" required min="1">
                    <label class="method">Datos de la tarjera</label>
                    <input type="text" required placeholder="Numero de la tarjeta">
                    <input type="password" required placeholder="Clave de Seguridad">
                    <input type="date" required placeholder="Vencimiento">
                </div>
            </form>
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
    </footer>
</body>
</html>