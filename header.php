<?php
session_start(); // Iniciar la sesión para acceder a las variables de sesión
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

// Verificar si el usuario está autenticado
if(isset($_SESSION['id_usuario'])) {
    // Si está autenticado, obtener el nombre y tipo de usuario
    $id_usuario = $_SESSION['id_usuario'];
    $sql_select_usuario = "SELECT Nombre, Tipo FROM usuarios WHERE ID_Usuario = '$id_usuario'";
    $resultado_select_usuario = $conn->query($sql_select_usuario);
    
    if ($resultado_select_usuario->num_rows > 0) {
        $fila_usuario = $resultado_select_usuario->fetch_assoc();
        $username = $fila_usuario['Nombre'];
        $tipo_usuario = $fila_usuario['Tipo'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <img class="imagenlogo" onclick="location.href='/proyecto/Inicio/index.php';" src="/proyecto/images/VOIDGG.png">   
        <div class="button-container">
            <button onclick="location.href='/proyecto/Inicio/index.php';" class="button">Inicio</button>
            <button onclick="location.href='https://discord.gg/4kRmxSY2hu';" class="button">Discord</button>      
            <button onclick="location.href='/proyecto/resources/soporte.php';" class="button">Soporte</button>       
            <?php if(isset($tipo_usuario) && $tipo_usuario == 'empleado') { ?>
                <a class="pedidos-button" href="/proyecto/resources/verpedidos.php">Pedidos</a>  
            <?php } ?>

        </div>
        
        <div class="button-container">
        <?php if(isset($username)) { ?>
                <a class="register-button2" href="/proyecto/resources/perfil_usuario.php"><?php echo $username; ?></a>
                <a class="login-button2" href="/proyecto/resources/logout.php">Cerrar Sesión</a> 
            <?php } else { ?>
                <button class="login-button" onclick="location.href='/proyecto/resources/login.php';">Login</button>  
                <button class="register-button" onclick="location.href='/proyecto/resources/registro.php'">Registrarme</button>
            <?php } ?>
           
        </div>


        
    </header>
</body>
</html>
