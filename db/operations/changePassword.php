<?php
    $email = $_POST["email"];
    $newPass = $_POST["newPass"];

    class Change {
        public function __construct($correo, $nuevaContrasena) {
            $this->correo = $correo;
            $this->nuevaContrasena = $nuevaContrasena;
        }
    }

    include_once("../connect.php");
    class ChangeDAO extends Connect {
        public function __construct() {
            parent::__construct();
        }

        public function changePass($user) {
            $sql = "UPDATE usuario set contrasena=? where correo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $user->nuevaContrasena);
            $stmt->bindParam(2, $user->correo);

            if ($stmt->execute()) {
                echo "contraseña cambiada con exito";
            } else {
                echo "problemas para actualizar";
            }
        }
    }

    $postgres = new ChangeDAO;
    $user = new Change($email, $newPass);
    $postgres->changePass($user);
?>