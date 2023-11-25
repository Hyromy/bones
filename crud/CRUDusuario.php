<?php
    class Usuario {
        public $id_usuario;
        public $nombre_usuario;
        public $ap_pat_usuario;
        public $ap_mat_usuario;
        public $correo;
        public $contrasena;
        public $no_telefono;

        public function __construct($id, $name, $pat, $mat, $email, $pass, $phone) {
            $this->id_usuario = $id;
            $this->nombre_usuario = $name;
            $this->ap_pat_usuario = $pat;
            $this->ap_mat_usuario = $mat;
            $this->correo = $email;
            $this->contrasena = $pass;
            $this->no_telefono = $phone;
        }
    }

    include_once("../db/connect.php");
    class UsuarioDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function createUser($user) {
            if (!(($user->nombre_usuario == "" || $user->nombre_usuario == null) ||
                ($user->correo == "" || $user->correo == null) ||
                ($user->contrasena == "" || $user->contrasena == null))) {
            
                if ($user->no_telefono != null || $user->no_telefono != "") {
                    $sql = "INSERT INTO usuario(nombre_usuario, ap_pat_usuario, ap_mat_usuario, correo, contrasena, no_telefono)
                        VALUES(?, ?, ?, ?, ?, ?);";
                    
                    $stmt = parent::get()->prepare($sql);
                    $stmt->bindParam(1, $user->nombre_usuario);
                    $stmt->bindParam(2, $user->ap_pat_usuario);
                    $stmt->bindParam(3, $user->ap_mat_usuario);
                    $stmt->bindParam(4, $user->correo);
                    $stmt->bindParam(5, $user->contrasena);
                    $stmt->bindParam(6, $user->no_telefono);
                } else {
                    $sql = "INSERT INTO usuario(nombre_usuario, ap_pat_usuario, ap_mat_usuario, correo, contrasena)
                    VALUES(?, ?, ?, ?, ?);";
                
                    $stmt = parent::get()->prepare($sql);
                    $stmt->bindParam(1, $user->nombre_usuario);
                    $stmt->bindParam(2, $user->ap_pat_usuario);
                    $stmt->bindParam(3, $user->ap_mat_usuario);
                    $stmt->bindParam(4, $user->correo);
                    $stmt->bindParam(5, $user->contrasena);
                }
        
                if (!$stmt->execute()) {
                    echo "<p style='color:#f00;'>Problemas al crear el usuario</p>";
                }
            } else {
                echo "<p style='color:#f00;'>Error por falta de datos requeridos en el usuario</p>";
            }
        }

        public function readUser($id) {
            $sql = "SELECT * FROM usuario WHERE id_usuario=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $user = $stmt->fetch(PDO::FETCH_OBJ);
                    return $user;
                } else {
                    echo "<p style='color:#f00;'>No existen registros de ese usuario</p>";
                }
            } else {
                echo "<p style='color:#f00;'>Problemas al leer el usuario</p>";
            }
        }

        public function readUserByEmail($email) {
            $sql = "SELECT * FROM usuario WHERE correo LIKE '%$email%';";

            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                $user = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $user;
            } else {
                echo "<p style='color:#f00;'>Problemas al leer el usuario</p>";
            }
        }

        public function readAllUsers() {
            $sql = "SELECT * FROM usuario;";

            $stmt = parent::get()->prepare($sql);

            if ($stmt->execute()) {
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $users;
            } else {
                echo "<p style='color:#f00;'>Problemas al leer los usuarios</p>";
            }
        }

        public function updateUser($user, $name, $pat, $mat, $email, $pass, $phone) {
            if ($name == null || $name == "" || $name == "_") {
                $name = $user->nombre_usuario;
            }

            if ($pat == null || $pat == "") {
                $pat = $user->ap_pat_usuario;
            } else if ($pat == "_") {
                $pat = null;
            }

            if ($mat == null || $mat == "") {
                $mat = $user->ap_mat_usuario;
            } else if ($mat == "_") {
                $mat = null;
            }

            if ($email == null || $email == "" || $email == "_") {
                $email = $user->correo;
            }

            if ($pass == null || $pass == "" || $email == "_") {
                $pass = $user->contrasena;
            }

            if ($phone == null || $phone == "") {
                $phone = $user->no_telefono;
            } else if ($phone == "_") {
                $phone = null;
            }

            $sql = "UPDATE usuario set nombre_usuario=?, ap_pat_usuario=?, ap_mat_usuario=?, correo=?, contrasena=?, no_telefono=?
                    WHERE id_usuario=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $pat);
            $stmt->bindParam(3, $mat);
            $stmt->bindParam(4, $email);
            $stmt->bindParam(5, $pass);
            $stmt->bindParam(6, $phone);
            $stmt->bindParam(7, $user->id_usuario);
            
            if (!$stmt->execute()) {
                echo "<p style='color:#f00;'>Problemas al actualizar el usuario</p>";
            }
        }

        public function deteleUser($id) {
            $sql = "DELETE FROM usuario WHERE id_usuario=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $id);

            if (!$stmt->execute()) {
                echo "<p style='color:#f00;'>Problemas al eliminar el usuario</p>";
            }
        }
    }
?>