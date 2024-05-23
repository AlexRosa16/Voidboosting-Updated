<?php
session_start();

require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';
include '/opt/lampp/htdocs/proyecto/header.php'; 

// Obtener el ID de usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Consulta SQL para obtener los pedidos del usuario actual
$sql = "SELECT ID_Pedido, ID_Cliente, ID_Cuenta, FechaPedido, EstadoPedido 
        FROM Pedidos
        WHERE ID_Usuario = $id_usuario"; 

$resultado = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pedidos</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        /* Estilos para el contenedor de pedidos */
        .pedidos-container {
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 20px;
        }

        /* Estilos para la tabla de pedidos */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilos para los botones */
        .btn {
            padding: 10px 20px;
            margin-right: 5px; /* Añade un margen entre los botones */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    echo "<div class='pedidos-container'>";
    echo "<h1>Pedidos</h1>";

    // Tabla para mostrar el listado de pedidos
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID Pedido</th>";
    echo "<th>ID Cliente</th>";
    echo "<th>ID Cuenta</th>";
    echo "<th>Fecha Pedido</th>";
    echo "<th>Estado</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Iterar sobre cada fila de resultados
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['ID_Pedido'] . "</td>";
        echo "<td>" . $fila['ID_Cliente'] . "</td>";
        echo "<td>" . $fila['ID_Cuenta'] . "</td>";
        echo "<td>" . $fila['FechaPedido'] . "</td>";
        echo "<td>" . $fila['EstadoPedido'] . "</td>";
        echo "<td>";
        echo "<button class='btn'>Ver</button>";
        echo "<button class='btn'>Editar</button>";
        echo "<button class='btn btn-warning'>Eliminar</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No hay pedidos registrados para este usuario</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>

</body>
</html>
