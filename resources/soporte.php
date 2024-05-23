<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
</head>
<body>
<?php

include '/opt/lampp/htdocs/proyecto/header.php';
?>

<div class = 'mainsuport'>
        <section class = 'seccionsuport'>
            <h2>¿Necesitas ayuda?</h2>
            <p>Si tienes problemas o preguntas sobre nuestros servicios, no dudes en contactar con nuestro equipo de soporte. Estamos aquí para ayudarte.</p>
        </section>

        <section class = 'seccionsuport'>
            <h2>Contacta con nosotros</h2>
            <form action="submit_support_form.php" method="POST">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Correo electrónico:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Enviar mensaje</button>
            </form>
        </section>

        <section  class = 'seccionsuport'>
            <h2>Otras formas de contacto</h2>
            <p>Email: <a href="mailto:support@voidboosting.gg">support@voidboosting.gg</a></p>
            <p>Teléfono: +34 601 36 75 54</p>
        </section>
    </div>


<?php
include '/opt/lampp/htdocs/proyecto/footer.html';
?>
</body>
</html>