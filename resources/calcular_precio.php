<?php
include '/opt/lampp/htdocs/proyecto/conf.php'; // Archivo que maneja la conexión a la base de datos
include '/opt/lampp/htdocs/proyecto/header.php'; 


// Definir la estructura de precios para cada combinación de elos
$precios = array(
    "Hierro" => array(
        "Hierro" => 0,
        "Bronce" => 20,
        "Plata" => 40,
        "Oro" => 60,
        "Platino" => 100,
        "Esmeralda" => 120,
        "Diamante" => 140,
        "Maestro" => 160,
        "Gran Maestro" => 180,
        "Challenger" => 200
    ),
    "Bronce" => array(
        "Hierro" => 20,
        "Bronce" => 0,
        "Plata" => 20,
        "Oro" => 40,
        "Platino" => 60,
        "Esmeralda" => 80,
        "Diamante" => 100,
        "Maestro" => 140,
        "Gran Maestro" => 160,
        "Challenger" => 180
    ),
    "Plata" => array(
        "Hierro" => 25,
        "Bronce" => 20,
        "Plata" => 0,
        "Oro" => 20,
        "Platino" => 45,
        "Esmeralda" => 65,
        "Diamante" => 80,
        "Maestro" => 100,
        "Gran Maestro" => 140,
        "Challenger" => 160
    ),
    "Oro" => array(
        "Hierro" => 40,
        "Bronce" => 30,
        "Plata" => 20,
        "Oro" => 0,
        "Platino" => 25,
        "Esmeralda" => 40,
        "Diamante" => 50,
        "Maestro" => 80,
        "Gran Maestro" => 120,
        "Challenger" => 160
    ),
    "Platino" => array(
        "Hierro" => 40,
        "Bronce" => 35,
        "Plata" => 30,
        "Oro" => 25,
        "Platino" => 0,
        "Esmeralda" => 20,
        "Diamante" => 40,
        "Maestro" => 80,
        "Gran Maestro" => 120,
        "Challenger" => 160
    ),
    "Esmeralda" => array(
        "Hierro" => 50,
        "Bronce" => 45,
        "Plata" => 40,
        "Oro" => 35,
        "Platino" => 30,
        "Esmeralda" => 0,
        "Diamante" => 30,
        "Maestro" => 80,
        "Gran Maestro" => 120,
        "Challenger" => 160
    ),
    "Diamante" => array(
        "Hierro" => 50,
        "Bronce" => 45,
        "Plata" => 40,
        "Oro" => 35,
        "Platino" => 30,
        "Esmeralda" => 20,
        "Diamante" => 0,
        "Maestro" => 80,
        "Gran Maestro" => 120,
        "Challenger" => 160
    ),
    "Maestro" => array(
        "Hierro" => 60,
        "Bronce" => 55,
        "Plata" => 50,
        "Oro" => 45,
        "Platino" => 30,
        "Esmeralda" => 20,
        "Diamante" => 10,
        "Maestro" => 0,
        "Gran Maestro" => 80,
        "Challenger" => 140
    ),
    "Gran Maestro" => array(
        "Hierro" => 70,
        "Bronce" => 65,
        "Plata" => 60,
        "Oro" => 55,
        "Platino" => 40,
        "Esmeralda" => 30,
        "Diamante" => 20,
        "Maestro" => 10,
        "Gran Maestro" => 0,
        "Challenger" => 10
    ),
    "Challenger" => array(
        "Hierro" => 80,
        "Bronce" => 75,
        "Plata" => 70,
        "Oro" => 65,
        "Platino" => 50,
        "Esmeralda" => 20,
        "Diamante" => 30,
        "Maestro" => 20,
        "Gran Maestro" => 10,
        "Challenger" => 0
    )
);

// Obtener los elos seleccionados por el usuario
$eloInicial = $_POST['elo_inicial'];
$eloDeseado = $_POST['elo_deseado'];

// Verificar si los elos seleccionados existen en la estructura de precios
if (isset($precios[$eloInicial]) && isset($precios[$eloInicial][$eloDeseado])) {
    // Obtener el precio correspondiente a los elos seleccionados
    $precio = $precios[$eloInicial][$eloDeseado];
} else {
    // Mostrar un mensaje de error si no se encuentra el precio para la combinación de elos seleccionada
    $precio = "No se encontró el precio para la combinación de elos seleccionada.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Eloboost</title>
    <link rel="stylesheet" href="/proyecto/css/index.css">
    <style>
        
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100%;
        }
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .result {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
        .buy-button {
            display: block;
            width: 50%;
            padding: 10px;
            margin: 20px auto 0;
            font-size: 1em;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        .buy-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Detalles de Eloboost</h2>
            <div class="result">
                <?php
                echo "Elo Inicial: $eloInicial<br>";
                echo "Elo Deseado: $eloDeseado<br>";
                echo "Precio: $precio";
                ?>
            </div>
            <form action="comprar.php" method="post">
                <input type="hidden" name="elo_inicial" value="<?php echo $eloInicial; ?>">
                <input type="hidden" name="elo_deseado" value="<?php echo $eloDeseado; ?>">
                <input type="hidden" name="precio" value="<?php echo $precio; ?>">
                <button type="submit" class="buy-button">Comprar</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php include '/opt/lampp/htdocs/proyecto/footer.html'; ?>
