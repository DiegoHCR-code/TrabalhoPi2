<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Petzone</title>
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
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
                                não foi possível deletar esse registro pois há outro cadastro que utiliza o mesmo como atributo.
                            </h4>
                            <p class="texto-center">Certifique-se de que não haja nenhum outro cadastro utilizando esse registro como atributo e tente novamente.</p>
                            <button class="botao">
                                <a href="config-animais.php">
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