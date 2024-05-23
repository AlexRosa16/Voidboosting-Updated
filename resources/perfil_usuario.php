<?php
session_start(); // Iniciar la sesión para acceder a las variables de sesión
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

include '/opt/lampp/htdocs/proyecto/header.php';


// Verificar si el usuario está autenticado
if(!isset($_SESSION['id_usuario'])) {
    // Si el usuario no está autenticado, redirigirlo a la página de inicio de sesión
    header("location: /proyecto/login.php");
    exit();
}

// Obtener el ID de usuario del usuario autenticado
$id_usuario = $_SESSION['id_usuario'];

// Consultar la base de datos para obtener los datos del usuario
$sql_select_usuario = "SELECT * FROM usuarios WHERE ID_Usuario = '$id_usuario'";
$resultado_select_usuario = $conn->query($sql_select_usuario);

// Verificar si se encontró el usuario
if ($resultado_select_usuario->num_rows > 0) {
    $usuario = $resultado_select_usuario->fetch_assoc();
    // Aquí puedes mostrar los datos del usuario, por ejemplo:
    

    // Añade más campos según sea necesario
} else {
    echo "No se encontraron datos de usuario.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 

    <style>
        
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 470px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
}

        h2 {
            color: #5c4a9e;
        }
        .user-data {
            margin-top: 20px;
        }
        .user-data p {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Perfil de Usuario</h2>
        <div class="user-data">
            <p><strong>Nombre de usuario:</strong> <?php echo $usuario['Nombre']; ?></p>
            <p><strong>Correo electrónico:</strong> <?php echo $usuario['CorreoElectronico']; ?></p>
            <p><strong>Tipo:</strong> <?php echo $usuario['Tipo']; ?></p>
            <!-- Agrega más campos según sea necesario -->
        </div>
    </div>
</body>
</html>

<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>