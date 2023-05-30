<?php

    session_start();

    if(isset($_GET['modo'])){
        if($_GET['modo'] == "invalid")
            $erro = "LOGIN INVÁLIDO, TENTE NOVAMENTE";
        else
            $erro = "VOCÊ PRECISA ESTAR LOGADO PARA ACESSAR!";
    }
    else
        $erro = "";

    if(isset($_SESSION)){

        if(isset($_SESSION['status'])){

            if($_SESSION['status'] == 'estoque')
            header('location: painel-produtos/painel-produtos.php');
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery.js"></script>
    <script src="painel-produtos/js/toggle-menu.js"></script>
    <title>Petzone</title>
</head>
    <body>
        <div id="principal">
            <form class="login" method="post" action="bd/logar.php">
                <h3 class="titulo-pequeno margin-bottom-1 flex-align-itens-center flex-justify-content-center">
                    Identifique-se para acessar
                </h3>
                <div class="input-txt-layout margin-bottom-1">
                    Usuario: 
                    <input type="text" name="txt-usuario" value ="" class="input-txt border-radius">
                </div>

                <div class="input-txt-layout margin-bottom-2">
                    Senha:
                    <input type="password" name="txt-senha" value ="" class="input-txt border-radius">
                </div>

                <h4 class="red-text"><?=$erro?></h4>

                <input type="submit" name="logar-estoque" value="Entrar" class="botao border-radius">

                <button class="botao border-radius border-none">
                    <a href="home.php">
                        VOLTAR
                    </a>
                </button>

            </form>
        </div>
    </body>
</html>