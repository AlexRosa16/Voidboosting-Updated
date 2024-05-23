<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Precio de Eloboost</title>
    <link rel="stylesheet" href="/proyecto/css/index.css"> 
    <style>
        .container {
            padding-top: 20px;
            text-align: center;
        }
        .principalaqui {
            height: 575px;
        }
        .elo-select {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }
        .elo-option {
            margin: 5px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            transition: transform 0.2s;
        }
        .elo-option img {
            height: 50px;
            width: 50px;
        }
        .elo-option:hover {
            transform: scale(1.1);
            border-color: #000;
        }
        .elo-option.selected {
            border-color: #000;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <?php include '/opt/lampp/htdocs/proyecto/header.php'; ?>

    <div class="principalaqui">
        <div class="container">
            <h2>Elige tu boosting personalizado</h2>
        </div>

        <form action="calcular_precio.php" method="POST">
            <div>
                <label for="elo_inicial">Elo Inicial:</label>
                <div class="elo-select" id="elo_inicial">
                    <div class="elo-option" data-value="Hierro"><img src="/proyecto/images/hierro.png" alt="Hierro"></div>
                    <div class="elo-option" data-value="Bronce"><img src="/proyecto/images/bronce.png" alt="Bronce"></div>  
                    <div class="elo-option" data-value="Plata"><img src="/proyecto/images/plata.png" alt="Plata"></div>
                    <div class="elo-option" data-value="Oro"><img src="/proyecto/images/oro.png" alt="Oro"></div>
                    <div class="elo-option" data-value="Platino"><img src="/proyecto/images/platino.png" alt="Platino"></div>
                    <div class="elo-option" data-value="Esmeralda"><img src="/proyecto/images/esmeralda.png" alt="Esmeralda"></div>
                    <div class="elo-option" data-value="Diamante"><img src="/proyecto/images/diamante.png" alt="Diamante"></div>
                    <div class="elo-option" data-value="Maestro"><img src="/proyecto/images/master.png" alt="Maestro"></div>
                    <div class="elo-option" data-value="Gran Maestro"><img src="/proyecto/images/grandmaster.png" alt="Gran Maestro"></div>
                    <div class="elo-option" data-value="Challenger"><img src="/proyecto/images/challenger.png" alt="Challenger"></div>
                </div>
                <input type="hidden" name="elo_inicial" id="elo_inicial_value">
            </div>
            <div>
                <label for="elo_deseado">Elo Deseado:</label>
                <div class="elo-select" id="elo_deseado">
                    <div class="elo-option" data-value="Hierro"><img src="/proyecto/images/hierro.png" alt="Hierro"></div>
                    <div class="elo-option" data-value="Bronce"><img src="/proyecto/images/bronce.png" alt="Bronce"></div>  
                    <div class="elo-option" data-value="Plata"><img src="/proyecto/images/plata.png" alt="Plata"></div>
                    <div class="elo-option" data-value="Oro"><img src="/proyecto/images/oro.png" alt="Oro"></div>
                    <div class="elo-option" data-value="Platino"><img src="/proyecto/images/platino.png" alt="Platino"></div>
                    <div class="elo-option" data-value="Esmeralda"><img src="/proyecto/images/esmeralda.png" alt="Esmeralda"></div>
                    <div class="elo-option" data-value="Diamante"><img src="/proyecto/images/diamante.png" alt="Diamante"></div>
                    <div class="elo-option" data-value="Maestro"><img src="/proyecto/images/master.png" alt="Maestro"></div>
                    <div class="elo-option" data-value="Gran Maestro"><img src="/proyecto/images/grandmaster.png" alt="Gran Maestro"></div>
                    <div class="elo-option" data-value="Challenger"><img src="/proyecto/images/challenger.png" alt="Challenger"></div>
                </div>
                <input type="hidden" name="elo_deseado" id="elo_deseado_value">
            </div>
            <input type="submit" value="Calcular Precio">
        </form>
    </div>
    <?php include '/opt/lampp/htdocs/proyecto/footer.html'; ?>

    <script>
        document.querySelectorAll('.elo-select').forEach(select => {
            select.addEventListener('click', event => {
                if (event.target.closest('.elo-option')) {
                    const option = event.target.closest('.elo-option');
                    const value = option.getAttribute('data-value');

                    select.querySelectorAll('.elo-option').forEach(el => el.classList.remove('selected'));
                    option.classList.add('selected');

                    if (select.id === 'elo_inicial') {
                        document.getElementById('elo_inicial_value').value = value;
                    } else {
                        document.getElementById('elo_deseado_value').value = value;
                    }
                }
            });
        });
    </script>
</body>
</html>
