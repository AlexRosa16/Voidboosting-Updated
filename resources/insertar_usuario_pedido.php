<?php

// Incluir el archivo de conexión a la base de datos
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

// Verificar si se recibieron los datos del pedido y del usuario
if (isset($_POST['pedidoId'], $_POST['usuarioId'])) {
    // Sanitizar y validar los datos recibidos
    $pedidoId = intval($_POST['pedidoId']);
    $usuarioId = intval($_POST['usuarioId']);

    // Realizar la inserción en la tabla de pedidos
    $sql_insert_pedido_usuario = "UPDATE Pedidos SET ID_Usuario = $usuarioId WHERE ID_Pedido = $pedidoId";

    if ($conn->query($sql_insert_pedido_usuario) === TRUE) {
        echo "Usuario asignado correctamente al pedido";
    } else {
        echo "Error al asignar el usuario al pedido: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "Error: Datos de pedido o usuario no recibidos";
}
?>
