<?php
    $id = $_POST["update"];

    include_once("CRUDmuseo.php");
    $Museo = new MuseoDAO;

    if (isset($_POST["set"])) {
        $name = $_POST["name"];

        $res = $_POST["res"];
        $est = $_POST["est"];
        $col = $_POST["col"];
        $str = $_POST["str"];
        $det = $_POST["det"];
        $map = $_POST["map"];
        $web = $_POST["web"];
        $mor = $_POST["mor"];
        $sta = $_POST["sta"];
        $vie = $_POST["vie"];

        $museum = $Museo->readMuseum($id);
        $Museo->updateMuseum($museum, $name, "cat", $res, $est, $col, $str, $det, $map, $web, $mor, $sta, $vie, "img");

        echo "Actualizado";
    }

    $museum = $Museo->readMuseum($id);
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
    <form action="" method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>CATEGORIA</th>
                <th>RESUMEN</th>
                <th>ESTADO</th>
                <th>COLONIA</th>
                <th>CALLE</th>
                <th>DETALLES</th>
                <th>MAPA</th>
                <th>PAGINA</th>
                <th>INFORMACION</th>
                <th>PUNTUACION</th>
                <th>VISITAS</th>
                <th>IMAGEN</th>
                <th>NOMBRE IMAGEN</th>
            </tr>
            <tr>
                <?php
                    echo "<td>" . $museum->id_museo . "</td>";
                    echo "<td><input name='name' value='" . $museum->nombre . "'></td>";
                    echo "<td>" . $museum->categoria . "</td>";
                    echo "<td><input name='res' value='" . $museum->sinopsis . "'></td>";
                    echo "<td><input name='est' value='" . $museum->estado . "'></td>";
                    echo "<td><input name='col' value='" . $museum->colonia . "'></td>";
                    echo "<td><input name='str' value='" . $museum->calle . "'></td>";
                    echo "<td><input name='det' value='" . $museum->detalles . "'></td>";
                    echo "<td><input name='map' value='" . $museum->map_url . "'></td>";
                    echo "<td><input name='web' value='" . $museum->address_url . "'></td>";
                    echo "<td><input name='mor' value='" . $museum->about . "'></td>";
                    echo "<td><input name='sta' value='" . $museum->puntuacion . "'></td>";
                    echo "<td><input name='vie' value='" . $museum->visitas . "'></td>";
                    echo "<td><img style='height: 128px;' src='../media/temp/" . $museum->img_name . "'></td>";
                    echo "<td>" . $museum->img_name . "</td>";
                ?>
            </tr>
        </table>
        <p>
            <input type="text" name="set" value="true" hidden>
            <input type="text" name="update" value="<?php echo $id?>" hidden>
            <button type="submit">Guardar</button>
            <button><a href="../admin/admin.php">Descartar y salir</a></button>
        </p>
    </form>
</body>
</html>