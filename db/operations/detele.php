<?php
    $id_museo = $_POST["id_museo"];

    include_once("../connect.php");
    class deleteMuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function delete($id) {
            $sql = "DELETE from museo where id_museo=?;";
            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->fetch(PDO::FETCH_OBJ);
            $nombre = $stmt->nombre;
            echo $nombre . "borrado con exito";
            $stmt->execute();
        }
    }

    $postgres = new deleteMuseoDAO;
    $postgres->delete($id_museo);
    header("location: insertMuseo.php");
?>