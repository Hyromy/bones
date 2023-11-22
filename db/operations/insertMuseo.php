<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar museo</title>
    <style>
        body{
            background-color: #000;
            color: #fff;
            font-family: 'calibri';
            margin: 1rem;
        }

        b{
            font-size: 2rem;
        }

        span{
            color: #f00;
        }

        a{
            color: #0bf;
        }

        table{
            border-collapse: collapse;
        }   

        tr, td, th{
            border: 2px solid #fff;
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <b>Insertar museo</b>
    <a href="../../">Salir</a>
    <p>Los campos con asterisco al inicio son obligatorios</p>
    <p>Para aquellos datos vacios o desconocidos inserte un "0"</p>
    <form method="post" enctype="multipart/form-data">
        <br><input type="text" name="nombre" required placeholder="*nombre del museo">
        <br><label>categorias (selecciona al menos 1)</label>
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
        <br><input type="text" name="sinopsis" required placeholder="*resumen corto del museo">
        <br><label>entidad federativa</label>
        <br><select name="estado">
            <option value="Estado de Mexico">estado de mexico</option>
        </select>
        <br><input type="text" name="colonia" required placeholder="*colonia">
        <br><input type="text" name="calle" required placeholder="*calle">
        <br><input type="text" name="detalles" placeholder="detalles de la direccion">
        <br><input type="text" name="map_url" placeholder="link de google maps">
        <br><input type="text" name="address_url" placeholder="link de la pagina oficial del museo">
        <br><input type="text" name="about" placeholder="*detalles sobre el museo">
        <br><input type="text" name="puntuacion" placeholder="cantidad de estrellas con BONES">
        <br><input type="text" name="visitas" placeholder="cantidad de visitas con BONES">
        <br><input type="file" name="img" placeholder="imagen del museo">
        <br><button type="submit">Guardar</button>
        <button type="reset">Limpiar</button>
    </form>
</body>
</html>

<?php
    class Museo {
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
        
        public function __construct($nombre, $categoria, $sinopsis, $estado, $colonia, $calle, $detalles, $map_url, $address_url, $about, $puntuacion, $visitas) {
            $this->nombre = $nombre;

            $box = "";
            $x = count($categoria) -1;
            $i = 0;
            foreach ($categoria as $cat) {
                if ($i != $x) {
                    $box .= $cat . ", ";
                } else {
                    $box .= $cat;
                }
                $i++;
            }

            $this->categoria = $box;
            $this->sinopsis = $sinopsis;
            $this->estado = $estado;
            $this->colonia = $colonia;
            $this->calle = $calle;
            $this->detalles = $detalles;
            $this->map_url = $map_url;
            $this->address_url = $address_url;
            $this->about = $about;
            $this->puntuacion = $puntuacion;
            $this->visitas = $visitas;
        }
    }

    include_once("../connect.php");
    class insertMuseoDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function insertMuseo($museo) {
            $path = "../../media/temp/";
            $img_name = $path.basename($_FILES["img"]["name"]);
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $img_name)) {
                $img_name = $_FILES["img"]["name"];
                
                echo "imagen subida con exito";

                $file = file_get_contents($img_name);
                $museo->img = bin2hex($file);
                
                $sql = "INSERT INTO museo(nombre, categoria, sinopsis, estado, colonia, calle, detalles, map_url, address_url, about, puntuacion, visitas, img, img_name) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, decode('{$museo->img}', 'hex'), ?);";
                $stmt = parent::get()->prepare($sql);
                
                $stmt->bindParam(1, $museo->nombre);
                $stmt->bindParam(2, $museo->categoria);
                $stmt->bindParam(3, $museo->sinopsis);
                $stmt->bindParam(4, $museo->estado);
                $stmt->bindParam(5, $museo->colonia);
                $stmt->bindParam(6, $museo->calle);
                $stmt->bindParam(7, $museo->detalles);
                $stmt->bindParam(8, $museo->map_url);
                $stmt->bindParam(9, $museo->address_url);
                $stmt->bindParam(10, $museo->about);
                $stmt->bindParam(11, $museo->puntuacion);
                $stmt->bindParam(12, $museo->visitas);
                $stmt->bindParam(13, $img_name);
                
                if ($stmt->execute()) {
                    echo $museo->nombre . " registrado con exito";
                } else {
                    echo "<span>problemas al registrar</span>";
                }
            } else {
                echo "error por falta de imagen";
            }
            
        }

        public function showMuseo() {
            $sql = "SELECT * from museo;";
            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                $museos = $stmt->fetchALL(PDO::FETCH_OBJ);
                return $museos;
            }
        }
    }

    $postgres = new insertMuseoDAO;
    $museos = $postgres->showMuseo();

    echo "  <h2>Lista de museos</h2>
            <form>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE</th>
                        <th>CATEGORIA</th>
                        <th>SINOPSIS</th>
                        <th>ESTADO</th>
                        <th>COLONIA</th>
                        <th>CALLE</th>
                        <th>MAPA</th>
                        <th>PAGINA</th>
                        <th>PUNTUACION</th>
                        <th>VISITAS</th>
                        <th>IMAGEN</th>
                    </tr>";
    
    foreach ($museos as $museo) {
        echo "  <tr>
                    <td>" . $museo->id_museo . "</td>
                    <td>" . $museo->nombre . "</td>
                    <td>" . $museo->categoria . "</td>
                    <td>" . $museo->sinopsis . "</td>
                    <td>" . $museo->estado . "</td>
                    <td>" . $museo->colonia . "</td>
                    <td>" . $museo->calle . "</td>
                    <td>" . $museo->address_url . "</td>
                    <td>" . $museo->id_museo . "</td>
                    <td>" . $museo->puntuacion . "</td>
                    <td>" . $museo->visitas . "</td>
                    <td>" . $museo->img_name . "</td>   
                </tr>";
    }

    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
        $categoria = $_POST["categoria"];
        $sinopsis = $_POST["sinopsis"];
        $estado = $_POST["estado"];
        $colonia = $_POST["colonia"];
        $calle = $_POST["calle"];
        $detalles = $_POST["detalles"];
        $map_url = $_POST["map_url"];
        $address_url = $_POST["address_url"];
        $about = $_POST["about"];
        $puntuacion = $_POST["puntuacion"];
        $visitas = $_POST["visitas"];
        $img = $_POST["img"];

        $a = true;
        $c = true;
        $d = true;
        $e = true;
        $f = true;
        $g = true;
        $h = true;
        $i = true;
        $j = true;

        if (strlen($nombre) > 128) {
            echo "<span>el nombre de museo es demaciado largo (" . strlen($nombre) . "/128)</span><br>";
            $a = false;            
        }
        if (strlen($sinopsis) > 300) {
            echo "<span>la sinopsis es demaciado larga (" . strlen($sinopsis) . "/300)</span><br>";
            $c = false;
        }
        if (strlen($estado) > 64) {
            echo "<span>el estado es demaciado largo (" . strlen($estado) . "/64)</span><br>";
            $d = false;
        }
        if (strlen($colonia) > 128) {
            echo "<span>la colonia es demaciado larga (" . strlen($colonia) . "/128)</span><br>";
            $e = false;
        }
        if (strlen($calle) > 128) {
            echo "<span>la calle es demaciado larga (" . strlen($calle) . "/128)</span><br>";
            $f = false;
        }
        if (strlen($detalles) > 128) {
            echo "<span>los detalles son demacido largos (" . strlen($detalles) . "/128)</span><br>";
            $g = false;
        }
        if (strlen($map_url) > 256) {
            echo "<span>el link del mapa es demaciado largo (" . strlen($map_url) . "/256)</span><br>";
            $h = false;
        }
        if (strlen($address_url) > 256) {
            echo "<span>el link del museo es demaciado largo (" . strlen($address_url) . "/256)</span><br>";
            $i = false;
        }
        if (strlen($about) > 2048) {
            echo "<span>la informacion del museo es demaciado larga (" . strlen($about) . "/2048)</span><br>";
            $j = false;            
        }

        if ($a && $c && $d && $e && $f && $g && $h && $i && $j) {
            $postgres = new insertMuseoDAO;
            $museo = new  Museo($nombre, $categoria, $sinopsis, $estado, $colonia, $calle, $detalles, $map_url, $address_url, $about, $puntuacion, $visitas, $img);
            $postgres->insertMuseo($museo);
        } else {
            echo "<span>algun parametro no se respeto</span>";
        }
    }
?>