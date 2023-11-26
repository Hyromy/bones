<?php
    include_once("../crud/CRUDmuseo.php");
    $Museo = new MuseoDAO;

    include_once("../crud/CRUDusuario.php");
    $Usuario = new UsuarioDAO;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body{
            background-color: black;
            color: #fff;
            font-family: 'calibri';
        }

        table{
            border-collapse: collapse;
        }

        tr, th, td{
            border: 2px solid #fff;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <form action="admin.php" method="post">
        <input type="text" name="reload" value="true" hidden>
        <button type="submit">Recargar</button>
    </form>
    <?php
        if (isset($_POST["reload"])) {
            header("location: ../admin/admin.php");
        }
    ?>

    <!-- MUSEOS -->
    <!-- INSERTAR -->
    <h2>Insertar Museo</h2>
    <form action='admin.php' method='post' enctype='multipart/form-data'>
        <label>nombre*</label><input required name="museum_name" type="text">
        <br><label>categoria* (seleccionar al menos una)</label>
        <br><label><input type="checkbox" name="categoria[]" value="Arte">arte</label>
        <br><label><input type="checkbox" name="categoria[]" value="Pintura">pintura</label>
        <br><label><input type="checkbox" name="categoria[]" value="Escultura">escultura</label>
        <br><label><input type="checkbox" name="categoria[]" value="Historia">historia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Paleontologia">paleontologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Geologia">geologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Ciencia">ciencia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Tecnologia">tecnologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Astronomia">astronomia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Antropologia">antropologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Cultura">cultura</label>
        <br><label><input type="checkbox" name="categoria[]" value="Arqueologia">arqueologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Historia">historia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Artesania">artesania</label>
        <br><label><input type="checkbox" name="categoria[]" value="Tematico">tematico</label>
        <br><label><input type="checkbox" name="categoria[]" value="Deporte">deporte</label>
        <br><label><input type="checkbox" name="categoria[]" value="Arquitectura">arquitectura</label>
        <br><label><input type="checkbox" name="categoria[]" value="Cine">cine</label>
        <br><label><input type="checkbox" name="categoria[]" value="Musica">musica</label>
        <br><label><input type="checkbox" name="categoria[]" value="Sociologia">sociologia</label>
        <br><label><input type="checkbox" name="categoria[]" value="Economia">economia</label>
        <br><label>resumen*</label><input required name="sinopsis" type="text">
        <br><label>estado*</label>
        <select name="estado">
            <option value="Estado de México">estado de mexico</option>
        </select>
        <br><label>colonia*</label><input required name="colonia" type="text">
        <br><label>calle*</label><input required name="calle" type="text">
        <br><label>detalles de la direccion</label><input name="detalles" type="text">
        <br><label>mapa</label><input name="map" type="text">
        <br><label>pagina</label><input name="web" type="text">
        <br><label>informacion*</label><input required name="informacion" type="text">
        <br><label>imagen*</label><input required name="img" type="file">
        <p><button type="submit">Enviar</button><button type="submit">Limpiar</button></p>
    </form>
    <?php
        if (isset($_POST["museum_name"])) {
            $name = $_POST["museum_name"];
            $cat = $_POST["categoria"];
            $res = $_POST["sinopsis"];
            $est = $_POST["estado"];
            $col = $_POST["colonia"];
            $str = $_POST["calle"];
            $det = $_POST["detalles"];
            $map = $_POST["map"];
            $web = $_POST["web"];
            $mor = $_POST["informacion"];

            // para prevenir falsos positivos
            error_reporting(E_ALL & ~E_NOTICE);
            $img = @$_POST["img"];
            error_reporting(E_ALL);

            $museum = new Museo("", $name, $cat, $res, $est, $col, $str, $det, $map, $web, $mor, "", "", $img, "");
            $Museo->createMuseum($museum);
        }
    ?>

    <!-- CONSULTAR -->
    <h2>Buscar museo por nombre</h2>
    <form action="admin.php" method="post">
        <label>Nombre a buscar</label><input type="text" name="get_name">
        <button type="submit">Buscar</button>
    </form>
    <?php
        if (isset($_POST["get_name"])) {
            $get_name = $_POST["get_name"];
            $museos_nombres = $Museo->readMuseumByName($get_name);

            echo "<table>";
            echo "<tr>";
            echo "<th colspan='12'>Resultados: " . count($museos_nombres) . "</th>";
            echo "</tr>";

            foreach ($museos_nombres as $museo_nombre) {
                echo "<tr>";
                echo "<td>" . $museo_nombre->id_museo . "</td>";
                echo "<td>" . $museo_nombre->nombre . "</td>";
                echo "<td>" . $museo_nombre->categoria . "</td>";
                echo "<td>" . $museo_nombre->estado . "</td>";
                echo "<td>" . $museo_nombre->colonia . "</td>";
                echo "<td>" . $museo_nombre->calle . "</td>";
                echo "<td>" . $museo_nombre->detalles . "</td>";
                echo "<td>" . $museo_nombre->puntuacion . "</td>";
                echo "<td>" . $museo_nombre->visitas . "</td>";
                echo "<td><img style='height: 128px;' src='../media/temp/" . $museo_nombre->img_name . "'></td>";
                echo "  <td>
                            <form action='../crud/Umuseo.php' method='post'>
                                <input hidden name='update' value='" . $museo_nombre->id_museo . "'>
                                <button>EDITAR</button>
                            </form> 
                        </td>";
                echo "  <td>
                            <form action='../crud/Dmuseo.php' method='post'>
                                <input hidden name='id' value='" . $museo_nombre->id_museo . "'>
                                <button type='submit'>ELIMINAR</button>
                            </form>
                        </td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
        }
    ?>

    <!-- REGISTROS -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Estado</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>Detalles</th>
            <th>Puntuacion</th>
            <th>Visitas</th>
            <th>Imagen</th>
            <th colspan=2>MODIFICAR</th>
        </tr>
        <?php
            $museos = $Museo->readAllMuseums();
            foreach ($museos as $museo) {
                echo "<tr>";
                echo "<td>" . $museo->id_museo . "</td>";
                echo "<td>" . $museo->nombre . "</td>";
                echo "<td>" . $museo->categoria . "</td>";
                echo "<td>" . $museo->estado . "</td>";
                echo "<td>" . $museo->colonia . "</td>";
                echo "<td>" . $museo->calle . "</td>";
                echo "<td>" . $museo->detalles . "</td>";
                echo "<td>" . $museo->puntuacion . "</td>";
                echo "<td>" . $museo->visitas . "</td>";
                echo "<td><img style='height: 128px;' src='../media/temp/" . $museo->img_name . "'></td>";
                echo "  <td>
                            <form action='../crud/Umuseo.php' method='post'>
                                <input hidden name='update' value='" . $museo->id_museo . "'>
                                <button>EDITAR</button>
                            </form>        
                        </td>";
                echo "  <td>
                            <form action='../crud/Dmuseo.php' method='post'>
                                <input hidden name='id' value='" . $museo->id_museo . "'>
                                <button type='submit'>ELIMINAR</button>
                            </form>    
                        </td>";
                echo "</tr>";
            }
        ?>
    </table>
    <hr>

















    <!-- USUARIOS -->
    <!-- INSERTAR -->
    <h2>Insertar Usuario</h2>
    <form action='admin.php' method='post'>
        <label>Nombre*</label><input required name='user_name' type="text">
        <br><label>Apellido Paterno</label><input name='pat' type="text">
        <br><label>Apellido Mataterno</label><input name='mat' type="text">
        <br><label>Correo*</label><input required name='email' type="text">
        <br><label>Contraseña*</label><input required name='pass' type="text">
        <br><label>N. Telefono</label><input name='phone' type="text">
        <p>
            <button type='submit'>Enviar</button>
            <button type='reset'>Limpiar</button>
        </p>
    </form>
    <?php
        if (isset($_POST["user_name"])) {
            $user_name = $_POST["user_name"];
            $pat = $_POST["pat"];
            $mat = $_POST["mat"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $phone = $_POST["phone"];
            
            $user = new Usuario("", $user_name, $pat, $mat, $email, $pass, $phone);
            $Usuario->createUser($user);
        }
    ?>

    <!-- CONSULTAR -->
    <h2>Buscar usuario por correo</h2>
    <form action="admin.php" method="post">
        <label>Correo a buscar</label><input type="text" name='get_email'>
        <button type="submit">Buscar</button>
    </form>
    <?php
        if (isset($_POST["get_email"])) {
            $get_email = $_POST["get_email"];
            $usuarios_correos = $Usuario->readUserByEmail($get_email);
            
            echo "<table>";
            echo "<tr>";
            echo "<th colspan='9'>Resultados: " . count($usuarios_correos) . "</th>";
            echo "</tr>";
            
            foreach ($usuarios_correos as $usuario_correo) {
                echo "<tr>";
                echo "<td>" . $usuario_correo->id_usuario . "</td>";
                echo "<td>" . $usuario_correo->nombre_usuario . "</td>";
                echo "<td>" . $usuario_correo->ap_pat_usuario . "</td>";
                echo "<td>" . $usuario_correo->ap_mat_usuario . "</td>";
                echo "<td>" . $usuario_correo->correo . "</td>";
                echo "<td>" . $usuario_correo->contrasena . "</td>";
                echo "<td>" . $usuario_correo->no_telefono . "</td>";
                echo "  <td>
                            <form action='../crud/Uuser.php' method='post'>
                                <input hidden name='update' value='" . $usuario_correo->id_usuario . "'>
                                <button>EDITAR</button>
                            </form>        
                        </td>";
                echo "  <td>
                            <form action='../crud/Duser.php' method='post'>
                                <input hidden name='id' value='" . $usuario_correo->id_usuario . "'>
                                <button type='submit'>ELIMINAR</button>
                            </form>        
                        </td>";
                echo "</tr>";
            }
            echo "</table><br><br>";
        }
    ?>

    <!-- REGISTROS -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Contraseña</th>
            <th>N. Telefono</th>
            <th colspan=2>MODIFICAR</th>
        </tr>
        <?php
            $usuarios = $Usuario->readAllUsers();
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td>" . $usuario->id_usuario . "</td>";
                echo "<td>" . $usuario->nombre_usuario . "</td>";
                echo "<td>" . $usuario->ap_pat_usuario . "</td>";
                echo "<td>" . $usuario->ap_mat_usuario . "</td>";
                echo "<td>" . $usuario->correo . "</td>";
                echo "<td>" . $usuario->contrasena . "</td>";
                echo "<td>" . $usuario->no_telefono . "</td>";
                echo "  <td>
                            <form action='../crud/Uuser.php' method='post'>
                                <input hidden name='update' value='" . $usuario->id_usuario . "'>
                                <button>EDITAR</button>
                            </form>        
                        </td>";
                echo "  <td>
                            <form action='../crud/Duser.php' method='post'>
                                <input hidden name='id' value='" . $usuario->id_usuario . "'>
                                <button type='submit'>ELIMINAR</button>
                            </form>        
                        </td>";
                echo "</form>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>