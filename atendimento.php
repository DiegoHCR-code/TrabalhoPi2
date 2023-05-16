<?php
if(isset($_SESSION)){
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzone</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/modulo.js"></script>
    <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
</head>
<body class="body-atendimento">
    <section class="atendimento">
        <div class="wrapper-atendimento">
        <div class="container container-atendimento">
        <div class="cliente-cadastrado">
            <form action="bd/autenticacao.php" class="cpf-cliente" method="post">
                <h1>Como podemos te ajudar hoje?</h1>
                <h3>Insira o telefone e entre!</h3>
                <div class="row">
                    <div class="input-field col s12">
                        <label for="last_name" class="last_name">TELEFONE/CELULAR</label>
                        <input id="last_name" onkeypress="return mascaraFone(this,event);" type="text" class="validate" name="txtcelular">
                    </div>
                    <button name="btn-autenticar" type="submit" class="botaoatendimento btn-hover">Entrar</button>
                </div>
                <div class="sign-up">
                    <h6 class="texto-signup btn-hover">
                        <a href="cadastrar-cliente.php">Cadastrar novo cliente</a>
                    </h6>
                    <h6 class="texto-signup btn-hover">
                        <a href="escolher-consumo.php">Entrar sem cadastrar</a>
                    </h6>
                </div>
            </form>
        </div>
    </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            M.updateTextFields();
        });
    </script>
</body>
</html>