<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/styles.css">
        <title>SIAP</title>
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
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
                        <div class="cpf-cliente-delete">
                            <h4 class="sub-titulo texto-center">
                                CLIENTE NÃO ENCONTRADO
                            </h4>
                            <p class="texto-center">Dica: Telefone/Celular não foi encontrado, certifique-se que o cliente já esteja cadastrado</p>
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