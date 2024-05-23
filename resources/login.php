<?php

require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';
    
if(isset($_REQUEST['hecho'])){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    // Consulta SQL para seleccionar el usuario con el nombre de usuario proporcionado
    $sql_select = "SELECT ID_Usuario, Nombre, ContraseñaHash FROM usuarios WHERE Nombre = '$username'";
    $resultado_select = $conn->query($sql_select);

    // Verificar si se encontró algún usuario con el nombre de usuario proporcionado
    if ($resultado_select->num_rows > 0) {
        // Obtener la fila de resultados
        $fila = $resultado_select->fetch_assoc();
        
        // Verificar si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
        if ($password === $fila['ContraseñaHash']) {
            // La contraseña es correcta
            $_SESSION['id_usuario'] = $fila['ID_Usuario']; // Establecer el ID_Usuario en la variable de sesión
            $_SESSION['nombreusuario'] = $fila['Nombre']; // Establecer el nombre del usuario en la variable de sesión


            /* echo "<script>
            alert('Inicio de sesión exitoso.');
            // Redirigir al usuario a otra página usando JavaScript
            window.location.href = '../Inicio/index.php';
         </script>";
         */ 
            header("location: ../Inicio/index.php");

    // Detener la ejecución del script
    exit();
            // Aquí puedes redirigir a la página principal u otras acciones que desees realizar después del inicio de sesión exitoso
        } else {
            // La contraseña es incorrecta
            echo "<script>alert('Contraseña incorrecta.');</script>";
        }
    } else {
        // No se encontró ningún usuario con el nombre de usuario proporcionado
        echo "<script>alert('Usuario no encontrado.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        h2 {
            color: #5c4a9e; /* Tono morado */
            text-align: center;
            padding: 20px;
        }
        .login-container {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
            overflow: hidden; /* Evita que .login-container tenga desbordamiento */
        }
        .login {
            width: 45%; /* Modifica el ancho para evitar desbordamiento */
            max-width: 400px; /* Añade un ancho máximo */
        }
        form {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6a55a9; /* Tono morado más oscuro */
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #5c4a9e;
        }
    </style>
</head>
<body>
<?php
include '/opt/lampp/htdocs/proyecto/header.php';
?>  
<h2>Iniciar Sesión</h2>
<div class="login-container">
    <div class="login">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="hecho" value = '1'><br>
            <input type="text" name="username" placeholder="Usuario" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar Sesión">
        </form>
    </div>
</div>

<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>
</body>
</html>
