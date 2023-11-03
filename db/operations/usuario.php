<?php
    $nombre = $_POST["nombre"];
    $paterno = $_POST["paterno"];
    $materno = $_POST["materno"];
    $correo = $_POST["correo"];
    $pass = $_POST["pass"];

    class Usuario {
        public $id_usuario;
        public $nombre_usuario;
        public $ap_pat_usuario;
        public $ap_mat_usuario;
        public $correo;
        public $contrasena;
        public $no_telefono;

        public function __construct($id_usuario, $nombre_usuario, $ap_pat_usuario, $ap_mat_usuario, $correo, $contrasena, $no_telefono) {
            $this->id_usuario = $id_usuario;
            $this->nombre_usuario = $nombre_usuario;
            $this->ap_pat_usuario = $ap_pat_usuario;
            $this->ap_mat_usuario = $ap_mat_usuario;
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->no_telefono = $no_telefono;
        }
    }

    include_once("../connect.php");
    class UserDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function createUser($user) {
            $sql = "INSERT INTO usuario(nombre_usuario, ap_pat_usuario, ap_mat_usuario, correo, contrasena) values(?, ?, ?, ?, ?);";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $user->nombre_usuario);
            $stmt->bindParam(2, $user->ap_pat_usuario);
            $stmt->bindParam(3, $user->ap_mat_usuario);
            $stmt->bindParam(4, $user->correo);
            $stmt->bindParam(5, $user->contrasena);

            if ($stmt->execute()) {
                echo "registrado<br>";
            } else {
                echo "problemas al registar<br>";
            }
        }
    }

    $postgres = new UserDAO;
    $user = new Usuario("", $nombre, $paterno, $materno, $correo, $pass, "");
    $postgres->createUser($user);
?>