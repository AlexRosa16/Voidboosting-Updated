<?php
session_start(); // Iniciar la sesión para acceder a las variables de sesión

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio o a donde prefieras
header("location: /proyecto/Inicio/index.php");
exit();
?>
