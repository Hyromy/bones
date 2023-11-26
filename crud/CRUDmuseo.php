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

            $box = "";
            $x = count($cat) -1;
            $i = 0;
            foreach ($cat as $c) {
                if ($i != $x) {
                    $box .= $c . ", ";
                } else {
                    $box .= $c;
                }
                $i++;
            }
            $this->categoria = $box;
            
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
            $img_name = $path.basename($_FILES["img"]["name"]);
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $img_name)) {
                $img_name = $_FILES["img"]["name"];
                $file = file_get_contents("../media/temp/" . $img_name);
                $museum->img = bin2hex($file);

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
                $stmt->bindParam(11, $img_name);
            
                if (!$stmt->execute()) {
                    echo "<p style='color:#f00;'>Problemas al crear el museo</p>";
                }
            } else {
                echo "<p style='color:#f00;'>Problemas al subir la imagen del museo</p>";
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

        public function readMuseumByName($name) {
            $sql = "SELECT * FROM museo WHERE nombre LIKE '%$name%';";

            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                $user = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $user;
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

        //funciones no disponibles
        //actualizar categoria
        //imagen y nombre de imagen
        public function updateMuseum($museum, $name, $cat, $res, $est, $col, $str, $det, $map, $web, $mor, $sta, $vie, $img) {
            if ($name == null || $name == "" || $name == "_") {
                $name = $museum->nombre;
            }

            /**
             * categoria pendiente
             */

            if ($res == null || $res == "" || $res == "_") {
                $res = $museum->sinopsis;
            }

            if ($est == null || $est == "" || $est == "_") {
                $est = $museum->estado;
            }

            if ($col == null || $col == "" || $col == "_") {
                $col = $museum->colonia;
            }

            if ($str == null || $str == "" || $str == "_") {
                $str = $museum->calle;
            }

            if ($det == null || $det == "") {
                $det = $museum->detalles;
            } else if ($det == "_") {
                $det = null;
            }
            
            if ($map == null || $map == "") {
                $map = $museum->map_url;
            } else if ($map == "_") {
                $map = null;
            }

            if ($web == null || $web == "") {
                $web = $museum->address_url;
            } else if ($web == "_") {
                $web = null;
            }

            if ($mor == null || $mor == "") {
                $mor = $museum->about;
            } else if ($mor == "_") {
                $mor = null;
            }

            if ($sta == null || $sta == "") {
                $sta = $museum->puntuacion;
            } else if ($sta == "_") {
                $sta = null;
            }

            if ($vie == null || $vie == "") {
                $vie = $museum->visitas;
            } else if ($vie == "_") {
                $vie = null;
            }

            /**
             * imagen pendiente
             */

            $sql = "UPDATE museo SET nombre=?, sinopsis=?, estado=?, colonia=?, calle=?, detalles=?, map_url=?, address_url=?, about=?, puntuacion=?, visitas=?
            WHERE id_museo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $res);
            $stmt->bindParam(3, $est);
            $stmt->bindParam(4, $col);
            $stmt->bindParam(5, $str);
            $stmt->bindParam(6, $det);
            $stmt->bindParam(7, $map);
            $stmt->bindParam(8, $web);
            $stmt->bindParam(9, $mor);
            $stmt->bindParam(10, $sta);
            $stmt->bindParam(11, $vie);
            $stmt->bindParam(12, $museum->id_museo);
            
            if (!$stmt->execute()) {
                echo "<p style='color:#f00;'>Problemas al actualizar el museo</p>";
            }
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