<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../../styles/access.css">
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
            $time = 1750;
            $find = "SELECT id_usuario from usuario where correo=?;";
            $stmtFind = parent::get()->prepare($find);
            $stmtFind->bindParam(1, $user->correo);
            $stmtFind->execute();
            
            if ($stmtFind->rowCount() == 1) {
                $id_usuario = $stmtFind->fetch();
                $id = $id_usuario["id_usuario"];

                $sql = "UPDATE usuario set contrasena=? where id_usuario=?;";
                $stmt = parent::get()->prepare($sql);
                $stmt->bindParam(1, $user->nuevaContrasena);
                $stmt->bindParam(2, $id);

                if ($stmt->execute()) {
                    echo "  <section>
                                <header>
                                    <img class='shield' src='../../media/img/bonesDino.png'>
                                    <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                    <h2>Contraseña restablecida</h2>
                                </header>
                            </section>
                            <script>setTimeout(function() {window.location.href = '../../'}, $time)</script>";
                } else {
                    echo "  <section>
                                <header>
                                    <img class='shield' src='../../media/img/bonesDino.png'>
                                    <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                    <h2>Hubo un problema<br>intentalo más tarde</h2>
                                </header>
                            </section>
                            <script>setTimeout(function() {window.location.href = '../../recuperar.html'}, $time)</script>";
                }
            } else {
                $time = 3000;
                echo "  <section>
                            <header>
                                <img class='shield' src='../../media/img/bonesDino.png'>
                                <br><img class='shieldText' src='../../media/img/bonesTitle.png'>
                                <h2>No se puede restablecer</h2>
                                <p>No existe ninguna cuenta asociada a '$user->correo'</p>
                            </header>
                        </section>
                        <script>setTimeout(function() {window.location.href = '../../recuperar.html'}, $time)</script>";
            }
        }
    }

    $postgres = new ChangeDAO;
    $user = new Change($email, $newPass);
    $postgres->changePass($user);
?>