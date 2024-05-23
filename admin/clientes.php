<?php
// Incluir el archivo de configuración
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php'; 

// Incluir el encabezado y el panel de navegación
include '/opt/lampp/htdocs/proyecto/header.php';
include '/opt/lampp/htdocs/proyecto/panel.html';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Clientes</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        /* Estilos para el contenedor de clientes */
        .clientes-container {
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 20px;
        }

        /* Estilos para la tabla de clientes */
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
// Conectar a la base de datos y obtener los clientes
$sql = "SELECT * FROM usuarios WHERE Tipo = 'cliente '";
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    echo "<div class='clientes-container'>";
    echo "<h1>Usuarios Clientes</h1>";

    // Crear una tabla para mostrar los clientes
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Nombre</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Iterar sobre cada fila de resultados y mostrar los datos
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila['ID_Usuario'] . "</td>";
        echo "<td>" . $fila['Nombre'] . "</td>";
        echo "<td>";
        echo "<button class='btn editar' data-id='" . $fila['ID_Usuario'] . "'>Editar</button>";
        echo "<button class='btn eliminar' data-id='" . $fila['ID_Usuario'] . "'>Eliminar</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    // Mensaje si no hay clientes registrados
    echo "<p>No hay clientes registrados</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
</div>

<?php
// Incluir el pie de página
include '/opt/lampp/htdocs/proyecto/footer.html';
?>

<script>
    // Agregar evento clic a los botones de editar
    document.querySelectorAll('.editar').forEach(button => {
        button.addEventListener('click', () => {
            const idUsuario = button.getAttribute('data-id');
            // Redirigir a la página de edición del cliente con el ID correspondiente
            window.location.href = '/proyecto/admin/editar_cliente.php?id=' + idUsuario;
        });
    });

    // Agregar evento clic a los botones de eliminar
    document.querySelectorAll('.eliminar').forEach(button => {
        button.addEventListener('click', () => {
            const idUsuario = button.getAttribute('data-id');
            // Confirmar y realizar la eliminación del cliente
            if (confirm('¿Estás seguro de eliminar este cliente?')) {
                window.location.href = '/proyecto/admin/eliminar_cliente.php?id=' + idUsuario;
                alert('Cliente eliminado'); 
            }
        });
    });
</script>

</body>
</html>
