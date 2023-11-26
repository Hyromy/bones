<?php
    $id = $_POST["id"];

    include_once("CRUDmuseo.php");
    $Museo = new MuseoDAO;
    $Museo->deteleMuseum($id);

    header("location: ../admin/admin.php")
?>