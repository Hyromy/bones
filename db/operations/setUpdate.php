<?php
    $nombre = $_POST["nombre"];
    $sinopsis = $_POST["sinopsis"];
    $estado = $_POST["estado"];
    $colonia = $_POST["colonia"];
    $calle = $_POST["calle"];
    $detalles = $_POST["detalles"];
    $mapa = $_POST["mapa"];
    $pagina = $_POST["pagina"];
    $informacion = $_POST["informacion"];
    $puntuacion = $_POST["puntuacion"];
    $visitas = $_POST["visitas"];
    $id = $_POST["id"];

    include_once("../connect.php");
    class setUpdateMuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function getUpdate($nombre, $sinopsis, $estado, $colonia, $calle, $detalles, $mapa, $pagina, $informacion, $puntuacion, $visitas, $id) {
            $sql = "UPDATE museo set nombre='$nombre', sinopsis='$sinopsis', estado='$estado', colonia='$colonia', calle='$calle', detalles='$detalles', map_url='$mapa', address_url='$pagina', about='$informacion', puntuacion=$puntuacion, visitas=$visitas where id_museo=$id;";
            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                header("location: update.php");
            } else {
                echo "error al actualizar";
            }
        }
    }

    $posgres = new setUpdateMuseoDAO;
    $posgres->getUpdate($nombre, $sinopsis, $estado, $colonia, $calle, $detalles, $mapa, $pagina, $informacion, $puntuacion, $visitas, $id);
?>