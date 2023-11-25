<?php
    $id = $_POST["update"];

    include_once("CRUDusuario.php");
    $Usuario = new UsuarioDAO;
    $user = $Usuario->readUser($id);

    if (isset($_POST["set"])) {
        $name = $_POST["name"];
        $pat = $_POST["pat"];
        $mat = $_POST["mat"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $phone = $_POST["phone"];

        $Usuario->updateUser($user, $name, $pat, $mat, $email, $pass, $phone);
        $user = $Usuario->readUser($id);

        echo "Actualizado";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body{
            background-color: black;
            color: #fff;
            font-family: 'calibri';
        }

        table{
            border-collapse: collapse;
        }

        tr, th, td{
            border: 2px solid #fff;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <form action='Uuser.php' method='post'>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Telefono</th>
            </tr>
            <tr>
                <?php
                    echo "<td>" . $user->id_usuario . "</td>";
                    echo "<td><input name='name' value='" . $user->nombre_usuario . "'></td>";
                    echo "<td><input name='pat' value='" . $user->ap_pat_usuario . "'></td>";
                    echo "<td><input name='mat' value='" . $user->ap_mat_usuario . "'></td>";
                    echo "<td><input name='email' value='" . $user->correo . "'></td>";
                    echo "<td><input name='pass' value='" . $user->contrasena . "'></td>";
                    echo "<td><input name='phone' value='" . $user->no_telefono . "'></td>";
                ?>
            </tr>
        </table>
        <p>
            <input type="text" name='set' value='true' hidden>
            <input type="text" name='update' value='<?php echo $id?>' hidden>
            <button type='submit'>Guardar</button>
            <button><a href="../admin/admin.php">Descarcar y salir</a></button>
        </p>  
    </form>
</body>
</html>