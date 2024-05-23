<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politicas y Privacidad</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    
</head>
<body>

<?php

include '/opt/lampp/htdocs/proyecto/header.php';
?>

<?php
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';  // Incluye el archivo de configuración de la base de datos  

// La consulta SQL que selecciona el contenido de la vista con id_vista = 2
$sql = "SELECT contenido FROM vistas WHERE id_vista = 3";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si hay resultados, se procesa cada fila encontrada
    while ($row = $result->fetch_assoc()) {
        echo $row["contenido"];  // Muestra el contenido
    }
} else {
    echo "No se encontraron resultados";  // Si no hay resultados, muestra un mensaje
}

$conn->close();  // Cierra la conexión a la base de datos
?>


<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>
   
</body>
</html>