<?php
include "config/db_conn.php";
session_start();

// Verificar si el usuario está autenticado y tiene el rol de editor
if (!isset($_SESSION['id_empleado']) || $_SESSION['id_rol'] != 2) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>Editor</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
  Application for editores
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <a href="add-new.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">Usuario</th>
          <th scope="col">Rol</th>
          <th scope="col">Proyecto</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT e.id_empleado, e.nombre, e.apellido, e.usuario, r.nombre AS rol, p.nombre AS proyecto FROM empleado e 
        INNER JOIN rol r ON e.id_rol = r.id_rol 
        INNER JOIN proyecto p ON e.id_proyecto = p.idproyecto";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["id_empleado"] ?></td>
            <td><?php echo $row["nombre"] ?></td>
            <td><?php echo $row["apellido"] ?></td>
            <td><?php echo $row["usuario"] ?></td>
            <td><?php echo $row["rol"] ?></td>
            <td><?php echo $row["proyecto"] ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row["id_empleado"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
