<?php
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    class Login {
        public function __construct($correo, $contrasena) {
            $this->correo = $correo;
            $this->contrasena = $contrasena;
        }
    }

    include_once("../connect.php");
    class LoginDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function loginUser($user) {
            $sql = "SELECT id_usuario from usuario where correo=? and contrasena=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $user->correo);
            $stmt->bindParam(2, $user->contrasena);

            $execute = $stmt->execute();
            $exists = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($execute && $exists) {
                $id_usuario = $exists["id_usuario"];
                echo "ID para el correo '" . $user->correo . "': " . $id_usuario;
            } else {
                echo "problemas para encontrar el usuario";
            }
        }
    }

    $postgres = new LoginDAO;
    $user = new Login($email, $pass);
    $postgres->loginUser($user);
?>