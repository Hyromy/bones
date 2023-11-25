<?php
    class Museo {
        public $id_museo;
        public $nombre;
        public $categoria;
        public $sinopsis;
        public $estado;
        public $colonia;
        public $calle;
        public $detalles;
        public $map_url;
        public $address_url;
        public $about;
        public $puntuacion;
        public $visitas;
        public $img;
        public $img_name;

        public function __construct($id, $name, $cat, $res, $est, $col, $str, $det, $map, $web, $mor, $sta, $vie, $img, $img_name) {
            $this->id_museo = $id;
            $this->nombre = $name;
            $this->categoria = $cat;
            $this->sinopsis = $res;
            $this->estado = $est;
            $this->colonia = $col;
            $this->calle = $str;
            $this->detalles = $det;
            $this->map_url = $map;
            $this->address_url = $web;
            $this->about = $mor;
            $this->puntuacion = $sta;
            $this->visitas = $vie;
            $this->img = $img;
            $this->img_name = $img_name;
        }
    }

    include_once("../db/connect.php");
    class MuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function createMuseum($museum) {
            $path = "../media/temp/";
            $imgName = $path.basename($_FILES["img"]["name"]);
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $imgName)) {
                $file = file_get_contents($imgName);
                $museum->img = bin2hex($file);

                $imgName = $_FILES["img"]["name"];
                $museum->img_name = $imgName;
            } else {
                echo "<p style='color:#f00;'>Problemas al subir la imagen del museo</p>";
            }

            $sql = "INSERT INTO museo(nombre, categoria, sinopsis, estado, colonia, calle, detalles, map_url, address_url, about, img, img_name) 
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, decode('{$museum->img}', 'hex'), ?);";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $museum->nombre);
            $stmt->bindParam(2, $museum->categoria);
            $stmt->bindParam(3, $museum->sinopsis);
            $stmt->bindParam(4, $museum->estado);
            $stmt->bindParam(5, $museum->colonia);
            $stmt->bindParam(6, $museum->calle);
            $stmt->bindParam(7, $museum->detalles);
            $stmt->bindParam(8, $museum->map_url);
            $stmt->bindParam(9, $museum->address_url);
            $stmt->bindParam(10, $museum->about);
            $stmt->bindParam(11, $museum->img_name);
            
            if (!$stmt->execute()) {
                echo "<p style='color:#f00;'>Problemas al crear el museo</p>";
            }
        }

        public function readMuseum($id) {
            $sql = "SELECT * FROM museo WHERE id_museo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $museum = $stmt->fetch(PDO::FETCH_OBJ);
                    return $museum;
                } else {
                    echo "<p style='color:#f00;'>No existen registros de ese museo</p>";
                }
            } else {
                echo "<p style='color:#f00;'>Problemas al leer el museo</p>";
            }
        }

        public function readAllMuseums() {
            $sql = "SELECT * FROM museo;";

            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                $museums = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $museums;
            } else {
                echo "<p style='color:#f00;'>Problemas al leer los museos</p>";
            }
        }

        public function updateMuseum($museum, $cosa) {
            // pendiente
        }

        public function deteleMuseum($id) {
            $sql = "DELETE FROM museo WHERE id_museo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);

            if (!$stmt->execute()) {
                echo "<p style='color:#f00;'>Problemas al eliminar el Museo</p>";
            }
        }
    }
?>