<?php
    require_once('modulos/verificar-status.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/painel.css">
        <link rel="stylesheet" href="css/reset.css">
        <script src="js/jquery.js"></script>
        <script src="js/toggle-menu.js"></script>
        <title>Petzone</title>

    </head>
    <body>
        <div id="painel-produtos">
            <?php
                require_once('modulos/menu.php');
            ?>
            <div class="auxiliar"></div>
            <div class="home-painel">
                <div class="container-welcome">
                    <div class="linha">
                        <div>
                            <img src="img/box.png" alt="home">
                        </div>
                    </div>
                    <h3 class="titulo">
                        Bem vindo ao seu estoque
                    </h3>
                    <h2 class="empresa-nome">
                        Petzone
                    </h2>
                    <p>
                        Neste painel você terá acesso à todas as informações referentes
                        aos seus serviços.                 
                    </p>
                    <p>
                        Use o menu de navegação lateral para vizualizar todas as opções.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>