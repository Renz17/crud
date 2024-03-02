<?php
include "../../config/db_conn.php";
if (isset($_POST["login"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Crear una sentencia preparada
    $sql = "SELECT id_empleado, nombre, apellido, id_rol FROM empleado WHERE usuario=? AND contraseña=?";
    $stmt = mysqli_stmt_init($conn);

    // Preparar la declaración
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "Error en la declaración SQL";
    } else {
        // Vincular los parámetros a la declaración
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        // Ejecutar la declaración
        mysqli_stmt_execute($stmt);

        // Obtener el resultado
        $result = mysqli_stmt_get_result($stmt);

        // Verificar si se encontró un usuario
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
                    header("Location: ../admin.php");
                    break;
                case 2: // Editor
                    header("Location: ../editor.php");
                    break;
                case 3: // User
                    header("Location: ../user.php");
                    break;
                default: // Si el rol no está definido
                    echo "Rol no reconocido";
                    break;
            }
        } else {
            header("Location: ../../index.php");
        }
    }
}
?>
