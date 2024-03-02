<?php
// Redirigir a default.php si se accede directamente al directorio raíz
header("Location: ./src/frontend/login.html");
exit; // Asegúrate de que el script se detenga después de la redirección
?>