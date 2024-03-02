<?php
include "../../config/db_conn.php";
// Include the Composer autoload.php file
require '../../vendor/autoload.php';

use Bcrypt\Bcrypt;

$id = $_GET["id_empleado"];

// SQL query to retrieve roles
$sql_roles = "SELECT id_rol, nombre FROM rol";
$resultado_roles = mysqli_query($conn, $sql_roles);

// SQL query to retrieve projects
$sql_proyectos = "SELECT idproyecto, nombre FROM Proyecto";
$resultado_proyectos = mysqli_query($conn, $sql_proyectos);

if (isset($_POST["submit"])) {
    $nombre = $_POST['first_name'];
    $apellido = $_POST['last_name'];
    $usuario = $_POST['user'];
    $contraseña = $_POST['password'];
    $id_rol = $_POST['rol'];
    $id_proyecto = $_POST['proyecto'];

    // Create an instance of the Bcrypt class
    $bcrypt = new Bcrypt();

    // Apply Bcrypt to encrypt the password
    $encrypted_password = $bcrypt->encrypt($contraseña);

    // Here you should apply security measures such as password hashing before storing it in the database

    $sql = "UPDATE `Empleado` SET `nombre`='$nombre', `apellido`='$apellido', `usuario`='$usuario', `contraseña`='$encrypted_password', `id_rol`='$id_rol', `id_proyecto`='$id_proyecto' WHERE id_empleado = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    // Si no se ha enviado el formulario de edición, obtener los datos del empleado para rellenar el formulario
    $sql_empleado = "SELECT * FROM `Empleado` WHERE id_empleado = $id LIMIT 1";
    $resultado_empleado = mysqli_query($conn, $sql_empleado);
    $row = mysqli_fetch_assoc($resultado_empleado);
}
?>
