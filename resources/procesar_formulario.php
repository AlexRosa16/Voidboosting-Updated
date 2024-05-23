<?php
require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php';


// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Prepara la consulta SQL de inserción
$sql = "INSERT INTO aplicacionesboosters (nombre_completo, edad, pais_residencia, correo_electronico, discord, summonername, region_servidor, rango_actual, experiencia_lol, roles_competencia, sido_booster_anteriormente, experiencia_booster, declaracion_integridad, motivacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepara la declaración
$stmt = $conn->prepare($sql);

// Vincula los parámetros con los valores del formulario
$stmt->bind_param("sissssssisssss", $nombre_completo, $edad, $pais_residencia, $correo_electronico, $discord, $summonername, $region_servidor, $rango_actual, $experiencia_lol, $roles_competencia, $sido_booster_anteriormente, $experiencia_booster, $declaracion_integridad, $motivacion);

// Obtén los datos del formulario (asegúrate de realizar la validación y limpieza necesarias)
$nombre_completo = $_POST["fullname"];
$edad = $_POST["age"];
$pais_residencia = $_POST["country"];
$correo_electronico = $_POST["email"];
$discord = $_POST["discord"] ?? null;
$summonername = $_POST["summonername"];
$region_servidor = $_POST["serverregion"];
$rango_actual = $_POST["rank"];
$experiencia_lol = $_POST["experience"];
$roles_competencia = isset($_POST["role_top"]) ? "Top " : "";
$roles_competencia .= isset($_POST["role_jungle"]) ? "Jungla " : "";
$roles_competencia .= isset($_POST["role_mid"]) ? "Mid " : "";
$roles_competencia .= isset($_POST["role_adc"]) ? "ADC " : "";
$roles_competencia .= isset($_POST["role_support"]) ? "Apoyo " : "";
$sido_booster_anteriormente = isset($_POST["previous_booster"]) ? "Sí" : "No";
$experiencia_booster = isset($_POST["experience_description"]) ? $_POST["experience_description"] : null;
$declaracion_integridad = isset($_POST["integrity"]) ? "Confirmada" : "No confirmada";
$motivacion = $_POST["motivation"];

// Ejecuta la consulta
if ($stmt->execute()) {
    echo "Aplicación enviada con éxito. ¡Gracias por aplicar!";
} else {
    echo "Error al enviar la aplicación: " . $stmt->error;
}

// Cierra la conexión y la declaración
$stmt->close();
$conn->close();
?>
