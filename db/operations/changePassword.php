<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../../data/access.css">
</head>
</html>


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
            //Faltan correciones para validar correo existente

            $sql = "UPDATE usuario set contrasena=? where correo=?;";

            $stmt = parent::get()->prepare($sql);
            $stmt->bindParam(1, $user->nuevaContrasena);
            $stmt->bindParam(2, $user->correo);

            $time = 1750;
            if ($stmt->execute()) {
                echo "  <section>
                            <header>
                                <img class='shield' src='../../media/img/bonesDino.png'>
                               <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                <h2>Contraseña restablecida</h2>
                            </header>
                        </section>
                        <script>setTimeout(function() {window.location.href = '../../acceso/iniciarsesion.html'}, $time)</script>";
            } else {
                echo "  <section>
                            <header>
                                <img class='shield' src='../../media/img/bonesDino.png'>
                                <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                <h2>Hubo un problema<br>intentalo más tarde</h2>
                            </header>
                        </section>
                        <script>setTimeout(function() {window.location.href = '../../acceso/recuperar.html'}, $time)</script>";
            }
        }
    }

    $postgres = new ChangeDAO;
    $user = new Change($email, $newPass);
    $postgres->changePass($user);
?>