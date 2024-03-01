<?php
include "config/db_conn.php";

if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id_empleado, nombre, apellido, id_rol FROM empleado WHERE usuario='$username' AND contraseña='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['id_empleado'] = $row['id_empleado'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['apellido'] = $row['apellido'];
        $_SESSION['id_rol'] = $row['id_rol'];

        // Redireccionar según el rol del usuario
        switch ($row['id_rol']) {
            case 1: // Admin
                header("Location: admin.php");
                break;
            case 2: // Editor
                header("Location: editor.php");
                break;
            case 3: // User
                header("Location: user.php");
                break;
            default: // Si el rol no está definido
                echo "Rol no reconocido";
                break;
        }
    } else {
        echo "Credenciales inválidas";
    }
}
?>
