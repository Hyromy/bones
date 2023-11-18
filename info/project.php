<?php
    $id_usuario = $_GET["user"];

    include_once("../db/connect.php");
    class ProjectDAO extends Connect {
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

    $postgres = new ProjectDAO;
    $user = $postgres->session($id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | Proyecto</title>
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
        <div class="spliter">Sobre el proyecto BONES</div>
        <article>
            <h3>Problema</h3>
            <p>En el Estado de México no hay difusión de los museos y la riqueza cultural por parte de la ciudadanía mexiquense, además de desconocimiento general en acontecimientos y exposiciones históricas, causando desinterés por el reconocimiento de los establecimientos, obras, exposiciones y precios. En donde la ciudadanía opta por el uso de Internet dejando de lado la experiencia de una visita presencial.</p>    
        </article>
        <article>
            <h3>Objetivo</h3>
            <p>Diseñar e implementar un gestor de visitas web a museos, siendo intuitivo, dinámico al usuario y funcionando como medio publicitario para los museos del Estado de México promoviendo las visitas presenciales.</p>    
        </article>
        <article>
            <h3>Proposito</h3>
            <p>Ser un intermediario y punto de venta entre el usuario y los museos en el Estado de México. Brindando las facilidades e información relevante basadas en las prestaciones disponibles del museo tales como nombre, temática, categorías, valoraciones, obras o exposiciones destacadas, precios, descuentos y posición en el mapa. Además de poder hacer recomendaciones personalizadas al usuario.</p>
        </article>
        <article>
            <h3>Vision del Proyecto</h3>
            <p>Ser una página funcional y escalable a largo plazo que facilite la navegación del usuario al buscar museos dentro del Estado de México otorgándole comodidad y facilidad al conocer información relevante del museo, así como en la adquisición de su boleto.</p>
        </article>
        <article>
            <h3>Funcionalidades</h3>
            <ul>
                <li>Registro de usuario (público en general y administradores de los museos)</li>
                <li>Permitir Inicio de sesión al usuario</li>
                <li>Sistema de cobro por tarjeta o Paypal (Visita guiada opcional al usuario)</li>
                <li>Validación del cobro mediante correo electrónico</li>
                <li>Emplear Uso de Google Maps</li>
                <li>Mostrar Barra de búsqueda</li>
                <li>Contemplar Sistema de tendencias (generar, operar y mostrar)</li>
                <li>Utilizar Comentarios y rating para estadísticas (valoraciones recopiladas y extraídas de cada museo)</li>
                <li>Mostrará Vista previa del museo e información destacada (horarios y precios)</li>
                <li>Permitirá Actualizaciones de la información publicada</li>
                <li>Clasificación de gustos personales</li>
            </ul>
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
            <a href="">
                <img src="../media/img/bonesDino.png">
                <br>Sobre BONES
            </a>
        </div>
    </footer>
</body>
</html>