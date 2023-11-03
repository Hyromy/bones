<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../../data/access.css">
</head>
</html>

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
            $time = 1750;
            if ($execute && $exists) {
                //$id_usuario = $exists["id_usuario"];
                //echo "ID para el correo '" . $user->correo . "': " . $id_usuario;
                echo "<script>window.location.href = '../../principal/inicio.html'</script>";
            } else {
                echo "  <section>
                            <header>
                                <img class='shield' src='../../media/img/bonesDino.png'>
                                <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                <h2>Correo o contraseña incorrectos</h2>
                            </header>
                        </section>
                        <script>setTimeout(function() {window.location.href = '../../acceso/iniciarsesion.html'}, $time)</script>";
            }
        }
    }

    $postgres = new LoginDAO;
    $user = new Login($email, $pass);
    $postgres->loginUser($user);
?>