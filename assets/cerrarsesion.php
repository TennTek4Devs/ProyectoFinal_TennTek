<?php
// Iniciar la sesión
session_start();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a login.php
header("Location: ../login.php");
exit();
?>