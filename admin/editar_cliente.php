<?php
// Verificar si se proporcionó un ID de usuario para editar
if (isset($_GET['id'])) {
    // Obtener el ID del usuario de la URL
    $idUsuario = $_GET['id'];

    // Conectar a la base de datos
    require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

    // Verificar si se envió el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        // Consulta para actualizar la información del usuario
        $sql = "UPDATE usuarios SET Nombre = '$nombre', CorreoElectronico = '$correo', ContraseñaHash = '$contraseña' WHERE ID_Usuario = $idUsuario";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Si se actualiza correctamente, redirigir a la página de clientes
            header("Location: /proyecto/admin/clientes.php");
            exit();
        } else {
            // Mostrar un mensaje de error si ocurre un problema
            echo "Error al actualizar el usuario: " . $conn->error;
        }
    }

    // Consulta para obtener la información del usuario a editar
    $sql = "SELECT * FROM usuarios WHERE ID_Usuario = $idUsuario";
    $resultado = $conn->query($sql);

    // Verificar si se encontró el usuario
    if ($resultado->num_rows > 0) {
        // Obtener los datos del usuario
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['Nombre'];
        $correo = $fila['CorreoElectronico'];
        $contraseña = $fila['ContraseñaHash'];
    } else {
        // Redirigir a la página de clientes si no se encuentra el usuario
        header("Location: /proyecto/admin/clientes.php");
        exit();
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Redirigir a la página de clientes si no se proporciona un ID de usuario
    header("Location: /proyecto/admin/clientes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
</head>
<body>

<h1>Editar Cliente</h1>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $idUsuario); ?>">
    <label for="nombre">Nombre:</label><br>
    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>"><br><br>
    
    <label for="correo">Correo Electrónico:</label><br>
    <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>"><br><br>
    
    <label for="contraseña">Contraseña:</label><br>
    <input type="password" id="contraseña" name="contraseña" value="<?php echo $contraseña; ?>"><br><br>
    
    <input type="submit" value="Guardar Cambios">
</form>

</body>
</html>
