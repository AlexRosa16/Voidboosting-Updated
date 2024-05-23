<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoidBoost.gg</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
</head>
<body>
<?php
include '/opt/lampp/htdocs/proyecto/header.php'; // Incluimos el encabezado HTML
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';  // Incluimos el archivo de configuración de la base de datos  

// La consulta SQL que selecciona el contenido de la primera vista
$sql = "SELECT contenido FROM vistas ORDER BY id_vista ASC LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
        // Si hay resultados, se procesa cada fila encontrada
    while($row = $result->fetch_assoc()) {
        echo $row["contenido"];
    }
} else {
    echo "No se encontraron resultados";
}

$conn->close();

include '/opt/lampp/htdocs/proyecto/footer.html'; // IncIncluimosluye el pie de página HTML
?>

    
</body>
</html>


