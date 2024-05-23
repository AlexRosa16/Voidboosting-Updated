<?php
// Incluir el archivo de configuración
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';

// Inicializar variables del formulario
$nombreCuenta = "";
$rangoActual = "";
$precio = "";
$imagen = "";

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos enviados por el formulario
    $nombreCuenta = $_POST["nombreCuenta"];
    $rangoActual = $_POST["rangoActual"];
    $precio = $_POST["precio"];
    
    $target_dir = "/opt/lampp/htdocs/proyecto/images/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false) {
            echo "El archivo es una imagen - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen";
            $uploadOk = 0;
        }
    }
    // Comprobar el tamaño del archivo
    if ($_FILES["imagen"]["size"] > 500000) {
        echo "Tu imagen es demasiado grande";
        $uploadOk = 0;
    }

    // Permitir solo ciertos formatos de archivo
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Solo se permiten archivos JPG, JPEG, PNG y GIF";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Lo siento, tu archivo no se pudo subir.";
    // Si todo está bien, intenta subir el archivo
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            echo "El archivo ". htmlspecialchars( basename( $_FILES["imagen"]["name"])). " ha sido subido.";
            $imagen = $target_file;
        } else {
            echo "Lo siento, hubo un error al subir tu archivo.";
        }
    }

    // Asegurarse de que todos los campos están llenos
    if (!empty($nombreCuenta) && !empty($rangoActual) && !empty($precio) && !empty($imagen)) {
        // Preparar la consulta SQL para insertar la nueva cuenta en la base de datos
        $sql = "INSERT INTO CuentasLOL (NombreCuenta, RangoActual, Precio) VALUES ('$nombreCuenta', '$rangoActual', '$precio')";

        // Ejecutar la consulta
        if ($conn->query($sql) === TRUE) {
            // Obtener el ID de la cuenta que se acaba de insertar
            $idCuenta = $conn->insert_id;

            // Insertar la ruta de la imagen en la tabla de fotos
            $sql = "INSERT INTO FotosCuentaLOL (ID_Cuenta, RutaFoto) VALUES ('$idCuenta', '$imagen')";

            if ($conn->query($sql) === TRUE) {
                echo "Cuenta y foto agregadas correctamente.";
            } else {
                echo "Error al agregar la foto: " . $conn->error;
            }
        } else {
            echo "Error al agregar la cuenta: " . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Añadir Cuenta LoL</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        /* Estilos para el contenedor de cuentas */
        .cuentas-container {
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ccc;
            padding: 20px;
        }

        /* Estilos para el formulario */
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="file"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Estilos para los botones */
        .btn {
            padding: 10px 20px;
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

<div class="cuentas-container">
    <h1>Añadir Cuenta de League of Legends</h1>

    <!-- Formulario para añadir una cuenta de LoL -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <label for="nombreCuenta">Nombre de la Cuenta:</label>
        <input type="text" name="nombreCuenta" id="nombreCuenta" value="<?php echo $nombreCuenta; ?>">

        <label for="rangoActual">Rango Actual:</label>
        <input type="text" name="rangoActual" id="rangoActual" value="<?php echo $rangoActual; ?>">

        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" value="<?php echo $precio; ?>">

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen">

        <input type="submit" class="btn" value="Añadir Cuenta">
    </form>
</div>
</div>

<?php include '/opt/lampp/htdocs/proyecto/footer.html'; ?>

</body>
</html>
