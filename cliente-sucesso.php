<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <title>Petzone</title>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <div class="pagina-inicial-atendimento">
            <?php
                require_once('./modulo/menu.php');
            ?>
            <div class="container-atendimento">
            
                <div class="filtros center">
                    <div class="cliente-cadastrado">
                        <div class="cpf-cliente-sucesso">
                            <h1 class="titulo texto-center">
                                Cliente cadastrado com sucesso!
                            </h1>
                            <button class="botao botaoatendimento">
                                <a href="atendimento.php">
                                    <h3>Voltar</h3>
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>