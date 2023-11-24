<?php
    include_once("museo.php");
    $Museo = new MuseoDAO;

    include_once("usuario.php");
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
    <h2>Insertar Museo</h2>
    <form>
        <label>nombre</label><input name="nombre" type="text">
        <br><label>categoria</label>
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
        <br><label>resumen</label><input name="sinopsis" type="text">
        <br><label>estado</label>
        <select name="estado">
            <option value="Estado de Mexico">estado de mexico</option>
        </select>
        <br><label>colonia</label><input name="colonia" type="text">
        <br><label>calle</label><input name="calle" type="text">
        <br><label>detalles de la direccion</label><input name="detalles" type="text">
        <br><label>mapa</label><input name="map" type="text">
        <br><label>pagina</label><input name="web" type="text">
        <br><label>informacion</label><input name="informacion" type="text">
        <br><label>imagen</label><input name="img" type="file">
        <p><button type="submit">Enviar</button><button type="submit">Limpiar</button></p>
    </form>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Estado</th>
            <th>Colonia</th>
            <th>Calle</th>
            <th>Detalles</th>
            <th>Mapa</th>
            <th>Pagina</th>
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
                echo "<td>" . $museo->map_url . "</td>";
                echo "<td>" . $museo->address_url . "</td>";
                echo "<td>" . $museo->puntuacion . "</td>";
                echo "<td>" . $museo->visitas . "</td>";
                echo "<td><img style='height: 128px;' src='../media/temp/" . $museo->img_name . "'></td>";
                echo "<td><button>EDITAR</button></td>";
                echo "<td><button>ELIMINAR</button></td>";
                echo "</tr>";
            }
        ?>
    </table>
    <hr>
    <h2>Insertar Usuario</h2>
    <form>
        <label>Nombre</label><input type="text">
        <br><label>Apellido Paterno</label><input type="text">
        <br><label>Apellido Mataterno</label><input type="text">
        <br><label>Correo</label><input type="text">
        <br><label>Contraseña</label><input type="text">
        <br><label>N. Telefono</label><input type="text">
        <p><button type='submit'>Enviar</button><button type='reset'>Limpiar</button></p>
    </form>
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
                echo "<td><button>EDITAR</button></td>";
                echo "<td><button>ELIMINAR</button></td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>