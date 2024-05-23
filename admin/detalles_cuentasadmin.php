<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cuenta</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        /* Estilos para la tarjeta de cuenta */

        .divcard {
            width: 100%;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .card {
            width: 500px; /* Ancho de la tarjeta */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .gallery-image {
            width: 100%; /* Ajustar el ancho de la imagen al 100% del contenedor */
            height: auto; /* Altura automática para mantener la proporción */
            display: block; /* Para centrar la imagen horizontalmente */
            margin: 0 auto; /* Para centrar la imagen horizontalmente */
            width: 200px;
            height: auto;
            padding: 20px;
        }

        .card h1 {
            font-size: 1.5em;
            padding: 10px;
            margin-top: 10px;
        }

        /* Estilos para el botón de comprar */
        .btn-comprar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        .btn-comprar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
<?php
include '/opt/lampp/htdocs/proyecto/header.php';
?>

<?php
// Configuración para mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir el archivo de configuración
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php'; 

// Obtener el ID de la cuenta desde la URL
$id_cuenta = $_GET['id_cuenta'];

// Consulta para obtener la información de la cuenta
$sql_cuenta = "SELECT * FROM CuentasLOL WHERE ID_Cuenta = $id_cuenta";
$result_cuenta = $conn->query($sql_cuenta);

// Consulta para obtener las fotos asociadas a la cuenta
$sql_fotos = "SELECT RutaFoto FROM FotosCuentaLOL WHERE ID_Cuenta = $id_cuenta";
$result_fotos = $conn->query($sql_fotos);

// Verificar si se encontró la cuenta
if ($result_cuenta->num_rows > 0) {
    // Obtener los datos de la cuenta
    $cuenta = $result_cuenta->fetch_assoc();

    // Mostrar la información de la cuenta
    echo "<div class='divcard'>";
    echo "<div class='card'>";
    echo "<h1>{$cuenta['NombreCuenta']}</h1>";
    echo "<p>{$cuenta['RangoActual']}</p>";
    echo "<p>{$cuenta['Precio']}</p>";

    // Mostrar las fotos asociadas a la cuenta
    if ($result_fotos->num_rows > 0) {
        echo "<div class='gallery'>";
        while ($foto = $result_fotos->fetch_assoc()) {
            echo "<img src='{$foto['RutaFoto']}' class='gallery-image'>";
        }
        echo "</div>";
    } else {
        echo "No hay fotos disponibles para esta cuenta.";
    }

    // Botón Comprar
    echo "<a href='comprar.php?id_cuenta={$cuenta['ID_Cuenta']}' class='btn-comprar'>Comprar</a>";
    echo "</div>"; // Cierre de la tarjeta
    echo "</div>"; // Cierre div de la tarjeta

} else {
    echo "Cuenta no encontrada";
}

// Cerrar la conexión a la base de datos si es necesario
$conn->close();
?>

<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>

</body>
</html>
