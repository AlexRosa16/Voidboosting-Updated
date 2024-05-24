<?php

require_once '/opt/lampp/htdocs/proyecto/Inicio/conf.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Clientes</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
       
       .contenidocuentas{
        display:flex;
        align-items: center;
        justify-content: center;
        padding: 20px;

       }
    

        .containercuentas {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Tres columnas */
            justify-content: center;
            gap: 20px; /* Espacio entre las cuentas */
            padding: 20px;
            width: 80%; /* Ajusta el ancho según sea necesario */
            margin-top: 20px; /* Espacio superior */
        }

        .cuenta {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .cuenta h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        .cuenta p {
            margin: 5px 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .gallery-image {
            width: 200px;
            height: auto;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<?php

include '/opt/lampp/htdocs/proyecto/header.php';
?>


<div class="contenidocuentas">
    <div class="containercuentas">
        <?php
        $sql = "SELECT 
                    c.ID_Cuenta,
                    c.NombreCuenta,
                    c.RangoActual,
                    c.Precio,
                    f.RutaFoto
                FROM 
                    CuentasLOL c
                LEFT JOIN
                    FotosCuentaLOL f ON c.ID_Cuenta = f.ID_Cuenta";
        $result = $conn->query($sql);

        // Creamos un array asociativo para agrupar las fotos por ID de Cuenta
        $cuentasConFotos = array();
        while($row = $result->fetch_assoc()) {
            $idCuenta = $row["ID_Cuenta"];
            if (!isset($cuentasConFotos[$idCuenta])) {
                $cuentasConFotos[$idCuenta] = array(
                    "ID_Cuenta" => $idCuenta,
                    "NombreCuenta" => $row["NombreCuenta"],
                    "RangoActual" => $row["RangoActual"],
                    "Precio" => $row["Precio"],
                    "Fotos" => array()
                );
            }
            // Agregamos las fotos asociadas a la cuenta al array correspondiente
            $cuentasConFotos[$idCuenta]["Fotos"][] = $row["RutaFoto"];
        }

        foreach ($cuentasConFotos as $cuenta) {
            echo "<div class='cuenta'>";
            echo "<p>" . $cuenta["NombreCuenta"] . "</p>";
            echo "<p>" . $cuenta["RangoActual"] . "</p>";
            echo "<p>" . $cuenta["Precio"] . "</p>";
            echo "<div class='gallery'>";
            foreach ($cuenta["Fotos"] as $foto) {
                // Obtener el nombre del archivo sin la ruta completa
                $nombreArchivo = substr($foto, strrpos($foto, '/') + 1);
                // Mostrar la imagen con la URL modificada
                echo "<img src='/proyecto/images/$nombreArchivo' class='gallery-image'>";
            }
            echo "</div>";
            // Utiliza directamente el ID de la cuenta en el enlace del botón "Detalles"
            echo "<a href='detalles_cuenta.php?id_cuenta=" . $cuenta["ID_Cuenta"] . "' class='btn-detalles'>Detalles</a>";
            echo "</div>";
        }
        
        
        $conn->close();
        ?>
    </div>
</div>
</div>

<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>



</body>


</html>
