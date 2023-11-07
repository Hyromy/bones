<?php
    $var = "prueba";
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BONES | <?php echo $var;?></title>
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
                <li><a href="inicio.php">INICIO</a></li>
                <li><a href="../menu/boletos.html">BOLETOS</a></li>
            </ul>
        </article>
        <article class="short">
            <a href="../acceso/iniciarsesion.html"><img class="imgSmall" src="../media/img/bones.ico"></a>
        </article>
    </header>
    <hr>
    <nav>
        <form class="src" action="busqueda.php" method="get">
            <img src="../media/img/buscar.png">
            <input name="busqueda" type="text" placeholder="Buscar museos">
        </form>
    </nav>
    <section class="container">
        <article class="museo">
            <div class="face">
                <div class="topic"><img src="../media/img/backgrundAccess.jpeg"></div>
                <div class="topic r">
                    <h2>Nombre del museo</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus perspiciatis ratione rem nesciunt. Incidunt dolores debitis dicta, libero fugiat eligendi eveniet commodi, nobis quae ipsam iure ea rerum aliquid.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus perspiciatis ratione rem nesciunt. Incidunt dolores debitis dicta, libero fugiat eligendi eveniet commodi, nobis quae ipsam iure ea rerum aliquid.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus doloribus perspiciatis ratione rem nesciunt. Incidunt dolores debitis dicta, libero fugiat eligendi eveniet commodi, nobis quae ipsam iure ea rerum aliquid.</p>
                </div>
            </div>
            <hr>
            <div class="bottom">
                <div class="address">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt accusamus facilis, perferendis optio vero ex sapiente adipisci. Cumque fugiat adipisci earum ratione aliquam voluptates, veniam error, tenetur repellat, obcaecati vitae?</p>
                    <p><a href=""><img src="../media/img/link.png"> Pagina oficial de "nombre del museo completo o parcial xd"</a></p>
                </div>
                <div class="data">
                    <h3>Datos generales</h3>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Hic consectetur fugit repellat maxime deserunt ullam veniam architecto at tenetur, repudiandae dolorem sed consequuntur doloribus corrupti nostrum atque voluptatem cum ratione.
                        Exercitationem, mollitia? Et, laborum dicta. Saepe rem sapiente vero esse, nemo velit illum accusamus ducimus eius cum atque vitae nobis minus, non dignissimos. Totam doloremque iste cumque fugit libero eos.
                        Ipsum corporis dolor unde. Ipsam inventore dignissimos obcaecati iste sapiente nesciunt, optio dolorum hic praesentium vel cumque minima alias amet vero possimus tempore. Doloremque ipsa totam incidunt rerum. Ut, minima!
                        Delectus odio, vitae beatae ullam tenetur facere hic. Perferendis quasi molestias nesciunt adipisci voluptatibus. Dicta quibusdam earum id voluptas vitae molestias, repellendus nihil. Aut porro at incidunt. Odio, illo repellendus!
                        Nobis nihil, dolorum asperiores fugiat nostrum voluptatem sit iste iure sapiente tempora animi recusandae, harum inventore eius maxime. Hic nostrum eligendi odit a, consequuntur eum consequatur ex deleniti doloribus laboriosam.
                    </p>
                </div>
            </div>
        </article>
        <article class="buyZone">
            <h2>Comprar boletos para Nombre museo</h2>
            <p>Selecciona fecha para escoger tus boletos</p>
            <form>
                <div>
                    <label>Dia de la visita</label><input type="date" required>
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