<?php
    require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';
    ?> 

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 

    <style>
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            width: 300px;
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        h2 {
            color: #5c4a9e; /* Tono morado */
            text-align: center;
            padding: 20px;
        }

        .menuregistro{
            margin-top: 50px;
            overflow: hidden; /* Evita que .login-container tenga desbordamiento */
            height:450px;
        }

        input[type="text"],
        input[type="password"],
        input[type="passwordconfirm"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #6a55a9;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5c4a9e;
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body>

<?php
    include '/opt/lampp/htdocs/proyecto/header.php'; ?> 
   <div class="menuregistro">
    <h2>Registrarse</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return comprobarContraseña()">
        <input type="hidden" name="hecho" value = '1'><br>
        <input type="text" name="username" placeholder="Nombre de usuario" required><br>
        <input type="email" name="email" placeholder="Correo electrónico" required><br>
        <input type="password" id="password" name="password" placeholder="Contraseña" required><br>
        <input type="password" id="passwordconfirm" name="passwordconfirm" placeholder="Confirmar Contraseña" required><br>
        <span id="error-message" class="error-message"></span>

        <select name="tipo">
            <option value="cliente">Cliente</option>
            <option value="empleado">Empleado</option>
        </select>

        <input type="submit" value="Registrarse">
    </form>
</div>

<?php include '/opt/lampp/htdocs/proyecto/footer.html'; ?>

<script>
function comprobarContraseña() {
    var password = document.getElementById("password").value;
    var passwordConfirm = document.getElementById("passwordconfirm").value;
    var errorMessage = document.getElementById("error-message");

    // Expresión regular para validar la contraseña
    var regex = /^(?=.*[A-Z])(?=.*\d).{7,}$/;

    if (!regex.test(password)) {
        errorMessage.innerText = "La contraseña debe tener al menos una letra mayúscula, un dígito y ser de al menos 7 caracteres de longitud";
        return false; // Evita que se envíe el formulario
    }

    if (password !== passwordConfirm) {
        errorMessage.innerText = "Las contraseñas no coinciden";
        return false; // Evita que se envíe el formulario
    }

    errorMessage.innerText = ""; // Limpia el mensaje de error si las contraseñas coinciden
    return true; // Permite enviar el formulario
}
</script>
</body>
</html>
<?php
if(isset($_REQUEST['hecho'])){
    $email = $_REQUEST['email'];
    $sql_select = "SELECT * FROM usuarios WHERE CorreoElectronico = '$email'";
    $resultado_select = $conn->query($sql_select);

    // Verificar si el correo electrónico ya existe en la base de datos
    if ($resultado_select->num_rows > 0) {
        // Si el correo electrónico ya existe, mostrar la alerta
        echo "<script>alert('El usuario ya existe en la base de datos.');</script>";
    } else {
        // Si el correo electrónico no existe, proceder con la inserción
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        $tipo = $_REQUEST['tipo'];

        // Query de inserción
        $sql_insert = "INSERT INTO usuarios (Nombre, CorreoElectronico, ContraseñaHash, Tipo) 
                       VALUES ('$username', '$email', '$password', '$tipo')";

        // Ejecutar la consulta de inserción
        if ($conn->query($sql_insert) === TRUE) {
            // Mostrar el mensaje de registro exitoso
            echo "<script>
                    alert('Usuario registrado exitosamente.');
                    // Redirigir al usuario a otra página usando JavaScript
                    window.location.href = '/proyecto/Inicio/index.php';
                 </script>";
            // Detener la ejecución del script
            exit();
        } else {
            // Si hay un error durante la inserción, mostrar el mensaje de error
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

?>