<?php

// Incluir el archivo de conexión a la base de datos
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

// Verificar si se recibieron los datos necesarios
if (isset($_POST['pedidoId']) && isset($_POST['clienteId']) && isset($_POST['cuentaId']) && isset($_POST['fechaPedido']) && isset($_POST['estadoPedido']) && isset($_POST['usuarioId'])) {
    $pedidoId = $_POST['pedidoId'];
    $clienteId = $_POST['clienteId'];
    $cuentaId = $_POST['cuentaId'];
    $fechaPedido = $_POST['fechaPedido'];
    $estadoPedido = $_POST['estadoPedido'];
    $usuarioId = $_POST['usuarioId'];

    // Consulta para actualizar los campos del pedido
    $sql = "UPDATE Pedidos SET ID_Cliente = ?, ID_Cuenta = ?, FechaPedido = ?, EstadoPedido = ?, ID_Usuario = ? WHERE ID_Pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iissii', $clienteId, $cuentaId, $fechaPedido, $estadoPedido, $usuarioId, $pedidoId);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Pedido actualizado correctamente";
    } else {
        echo "Error al actualizar el pedido: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
} else {
    echo "Datos incompletos";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
