<?php

// Incluir el archivo de conexión a la base de datos
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';
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

<?php include '/opt/lampp/htdocs/proyecto/header.php'; ?>
<?php include '/opt/lampp/htdocs/proyecto/panel.html'; ?>

<?php
// Consulta SQL para obtener los usuarios de tipo empleado
$sql_usuarios_empleado = "SELECT ID_Usuario, Nombre FROM usuarios WHERE Tipo = 'empleado'";
$resultado_usuarios_empleado = $conn->query($sql_usuarios_empleado);
$usuarios_empleados = [];
while ($usuario_empleado = $resultado_usuarios_empleado->fetch_assoc()) {
    $usuarios_empleados[] = $usuario_empleado;
}
?>

<?php
// Consulta SQL para obtener los pedidos
$sql_pedidos = "SELECT ID_Pedido, ID_Cliente, ID_Cuenta, FechaPedido, EstadoPedido FROM Pedidos";
$resultado_pedidos = $conn->query($sql_pedidos);

// Verificar si hay resultados
if ($resultado_pedidos->num_rows > 0) {
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
    echo "<th>Empleado Asignado</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    // Iterar sobre cada fila de resultados
    while ($fila = $resultado_pedidos->fetch_assoc()) {
        echo "<tr>";
        echo "<td contenteditable='true'>" . $fila['ID_Pedido'] . "</td>";
        echo "<td contenteditable='true'>" . $fila['ID_Cliente'] . "</td>";
        echo "<td contenteditable='true'>" . $fila['ID_Cuenta'] . "</td>";
        echo "<td contenteditable='true'>" . $fila['FechaPedido'] . "</td>";
        echo "<td>";
        echo "<select name='estado_pedido'>";
        echo "<option value='pendiente'" . ($fila['EstadoPedido'] == 'pendiente' ? ' selected' : '') . ">Pendiente</option>";
        echo "<option value='en proceso'" . ($fila['EstadoPedido'] == 'en proceso' ? ' selected' : '') . ">En Proceso</option>";
        echo "<option value='finalizado'" . ($fila['EstadoPedido'] == 'finalizado' ? ' selected' : '') . ">Finalizado</option>";
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<select name='empleado_asignado'>";
        // Iterar sobre los usuarios de tipo empleado y crear opciones para el selector
        foreach ($usuarios_empleados as $usuario_empleado) {
            echo "<option value='" . $usuario_empleado['ID_Usuario'] . "'>" . $usuario_empleado['Nombre'] . "</option>";
        }
        echo "</select>";
        echo "</td>";
        echo "<td>";
        echo "<button class='btn editar' data-pedido='" . $fila['ID_Pedido'] . "'>Editar</button>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No hay pedidos registrados</p>";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
</div>
<?php include '/opt/lampp/htdocs/proyecto/footer.html'; ?>

<script>
// Agregar un evento clic para el botón de editar
document.querySelectorAll('.editar').forEach(btn => {
    btn.addEventListener('click', function() {
        // Obtener la fila actual
        const row = this.parentNode.parentNode;
        
        // Obtener los valores editados
        const pedidoId = row.querySelector('td:nth-child(1)').textContent;
        const clienteId = row.querySelector('td:nth-child(2)').textContent;
        const cuentaId = row.querySelector('td:nth-child(3)').textContent;
        const fechaPedido = row.querySelector('td:nth-child(4)').textContent;
        const estadoPedido = row.querySelector('select[name="estado_pedido"]').value;
        const usuarioId = row.querySelector('select[name="empleado_asignado"]').value;

        // Realizar la solicitud AJAX al servidor para actualizar el pedido
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/proyecto/admin/actualizar_pedido.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Mostrar una notificación o realizar alguna otra acción en caso de éxito
                console.log('Pedido actualizado correctamente');
            }
        };
        xhr.send(
            'pedidoId=' + encodeURIComponent(pedidoId) +
            '&clienteId=' + encodeURIComponent(clienteId) +
            '&cuentaId=' + encodeURIComponent(cuentaId) +
            '&fechaPedido=' + encodeURIComponent(fechaPedido) +
            '&estadoPedido=' + encodeURIComponent(estadoPedido) +
            '&usuarioId=' + encodeURIComponent(usuarioId)
        );
    });
});
</script>

</body>
</html>
