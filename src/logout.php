<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_destroy();

// Redireccionar al usuario a la página de inicio de sesión
header("Location: frontend/login.html");
exit;
?>
