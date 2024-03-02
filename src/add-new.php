<?php
include "../config/db_conn.php";
// Include the Composer autoload.php file
require '../vendor/autoload.php';

use Bcrypt\Bcrypt;

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

   $sql = "INSERT INTO Empleado (nombre, apellido, usuario, contraseña, id_rol, id_proyecto) VALUES ('$nombre', '$apellido', '$usuario', '$encrypted_password', '$id_rol', '$id_proyecto')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: admin.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD Application</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
      PHP Complete CRUD Application
   </nav>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New User</h3>
         <p class="text-muted">Complete the form below to add a new user</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Nombre:</label>
                  <input type="text" class="form-control" name="first_name" placeholder="Albert">
               </div>

               <div class="col">
                  <label class="form-label">Apellido:</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Einstein">
               </div>
            </div>
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Usuario:</label>
                  <input type="text" class="form-control" name="user" placeholder="">
               </div>

               <div class="col">
                  <label class="form-label">Contraseña:</label>
                  <input type="password" class="form-control" name="password" placeholder="">
               </div>
            </div>
            <div class="row mb-3">
            <div class="col">
                <label class="form-label">Rol:</label>
                <select class="form-select" name="rol">
                <?php
                     // Generate options for roles
                     while ($row = mysqli_fetch_assoc($resultado_roles)) {
                        echo "<option value='" . $row['id_rol'] . "'>" . $row['nombre'] . "</option>";
                     }
                     ?>
                </select>
            </div>

            <div class="col">
                <label class="form-label">Proyecto:</label>
                <select class="form-select" name="proyecto">
                <?php
                     // Generate options for projects
                     while ($row = mysqli_fetch_assoc($resultado_proyectos)) {
                        echo "<option value='" . $row['idproyecto'] . "'>" . $row['nombre'] . "</option>";
                     }
                     ?>
                </select>
            </div>
        </div>
            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="admin.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>