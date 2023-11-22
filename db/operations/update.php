<?php
    $id_museo = $_POST["id_museo"];

    include_once("../connect.php");
    class updateMuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }
    
        public function getValues($id) {
            $sql = "SELECT * from museo where id_museo=?;";
            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $museo = $stmt->fetch(PDO::FETCH_OBJ);
            return $museo;
        }
    }

    $postgres = new updateMuseoDAO;
    $museo = $postgres->getValues($id_museo);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h2>Actualizar</h2>
    <form action="setUpdate.php" method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>SINOPSIS</th>
                <th>ESTADO</th>
                <th>COLONIA</th>
                <th>CALLE</th>
                <th>DETALLES</th>
                <th>MAPA</th>
                <th>PAGINA</th>
                <th>INFORMACION</th>
                <th>PUNTUACION</th>
                <th>VISITAS</th>
            </tr>
            <tr>
                <td><input name="id" value="<?php echo $museo->id_museo;?>" type="text"></td>
                <td><input name="nombre" value="<?php echo $museo->nombre;?>" type="text"></td>
                <td><input name="sinopsis" value="<?php echo $museo->sinopsis;?>" type="text"></td>
                <td><input name="estado" value="<?php echo $museo->estado;?>" type="text"></td>
                <td><input name="colonia" value="<?php echo $museo->colonia;?>" type="text"></td>
                <td><input name="calle" value="<?php echo $museo->calle;?>" type="text"></td>
                <td><input name="detalles" value="<?php echo $museo->detalles;?>" type="text"></td>
                <td><input name="mapa" value="<?php echo $museo->map_url;?>" type="text"></td>
                <td><input name="pagina" value="<?php echo $museo->address_url;?>" type="text"></td>
                <td><input name="informacion" value="<?php echo $museo->about;?>" type="text"></td>
                <td><input name="puntuacion" value="<?php echo $museo->puntuacion;?>" type="text"></td>
                <td><input name="visitas" value="<?php echo $museo->visitas;?>" type="text"></td>
            </tr>
        </table>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>