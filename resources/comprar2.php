<?php
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php'; 


// Verificar si el usuario está logueado
if (!isset($_SESSION['nombreusuario'])) {
    header('Location: login.php'); // Redirigir al login si no está logueado
    exit();
}

// Obtener los datos del formulario
$eloInicial = $_GET['elo_inicial'];
$eloDeseado = $_GET['elo_deseado'];
$precio = $_GET['precio'];
$id_cuenta = $_GET['id_cuenta']; // Obtener ID_Cuenta desde la URL

// Obtener el nombre de usuario logueado
$username = $_SESSION['nombreusuario'];

// Verificar si el cliente ya existe en la tabla de Clientes
$query = "SELECT * FROM Clientes WHERE Nombre = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Si no existe, crear un nuevo cliente
    $query = "INSERT INTO Clientes (Nombre, CorreoElectronico, ContraseñaHash) SELECT Nombre, CorreoElectronico, ContraseñaHash FROM Usuarios WHERE Nombre = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $cliente_id = $stmt->insert_id;
} else {
    // Si existe, obtener el ID del cliente
    $cliente = $result->fetch_assoc();
    $cliente_id = $cliente['ID_Cliente'];
}


// Crear un nuevo pedido
$query = "INSERT INTO Pedidos (ID_Cliente, ID_Servicio, ID_Cuenta, FechaPedido, EstadoPedido, ID_Usuario) VALUES (?, ?, ?, NOW(), 'Pendiente', ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiii", $cliente_id, $servicio_id, $id_cuenta, $_SESSION['id_usuario']); // Usar el ID de usuario correcto aquí
$stmt->execute();

// Redirigir a una página de confirmación después de todas las operaciones
header('Location: confirmacion.php');
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
</head>
<body>

<?php
include '/opt/lampp/htdocs/proyecto/header.php';
?>
<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>
</body>
</html>
