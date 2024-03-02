<?php
include "../../config/db_conn.php";
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro
    $sql_delete = "DELETE FROM empleado WHERE id_empleado = $id";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        // Obtener los registros restantes y renumerar los IDs
        $sql_renumber = "SET @counter = 0;
                         UPDATE empleado SET id_empleado = @counter := @counter + 1;
                         ALTER TABLE empleado AUTO_INCREMENT = 1;";
        mysqli_multi_query($conn, $sql_renumber);

        header("Location: ../admin.php?msg=Registro eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }
} else {
    header("Location: ../admin.php");
    exit();
}
?>