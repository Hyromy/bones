<?php
    $id = $_POST["id"];

    include_once("CRUDusuario.php");
    $Usuario = new UsuarioDAO;
    $Usuario->deteleUser($id);

    header("location: ../admin/admin.php");
?>