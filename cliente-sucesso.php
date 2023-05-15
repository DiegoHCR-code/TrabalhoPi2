<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/styles.css">
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <title>SIAP</title>
    </head>
    <body>
        <div class="pagina-inicial-atendimento">
            <?php
                require_once('./modulo/menu.php');
            ?>
            <div class="help">
                <img src="./icon/question.png" alt="ask">
                <div class="devContato">
                    <div>
                        <p>Dúvidas? Entre em contato com o Dev.</p>
                        <br>
                        <p>555-123</p>
                    </div>
                </div>       
            </div>
            <div class="container-atendimento">
            
                <div class="filtros center">
                    <div class="cliente-cadastrado">
                        <div class="cpf-cliente-sucesso">
                            <h1 class="titulo texto-center">
                                Cliente cadastrado com sucesso!
                            </h1>
                            <button class="botao">
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