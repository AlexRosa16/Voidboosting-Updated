<?php
session_start(); // Iniciar la sesión (si no está iniciada ya)

// conf.php
$servername = "localhost";
$usernamebase = "root";
$password = "usuario";
$database = "Voidboosting";

// Crear conexión
$conn = new mysqli($servername, $usernamebase, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
