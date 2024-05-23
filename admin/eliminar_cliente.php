<?php

// Verificar si se proporcionó un ID de usuario para eliminar
if (isset($_GET['id'])) {
    
    // Obtener el ID del usuario desde la URL
    $idUsuario = $_GET['id'];

    // Conectar a la base de datos
    require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

    // Iniciar una transacción
    $conn->begin_transaction();

    try {
        // Consulta para eliminar los pedidos relacionados con el usuario
        $sqlPedidos = "DELETE FROM Pedidos WHERE ID_Usuario = $idUsuario";
        if (!$conn->query($sqlPedidos)) {
            throw new Exception("Error al eliminar pedidos relacionados: " . $conn->error);
        }

        // Consulta para eliminar el usuario con el ID especificado
        $sqlUsuario = "DELETE FROM usuarios WHERE ID_Usuario = $idUsuario";
        if (!$conn->query($sqlUsuario)) {
            throw new Exception("Error al eliminar el usuario: " . $conn->error);
        }

        // Confirmar la transacción
        $conn->commit();

        // Redirigir a la página de clientes
        header("Location: /proyecto/admin/clientes.php");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción si ocurre un error
        $conn->rollback();

        // Mostrar un mensaje de error
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Redirigir a la página de clientes si no se proporciona un ID de usuario
    header("Location: /proyecto/admin/clientes.php");
    exit();
}
?>
