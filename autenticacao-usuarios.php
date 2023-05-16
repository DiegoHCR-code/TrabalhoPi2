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
            if($_SESSION['status'] == "usuario")
                header('location: criar-usuario.php');
        }
            

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="painel-produtos/js/toggle-menu.js"></script>
    <title>PetZone</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
</head>
    <body class="body-secao-principal">
        <section>
            <div class="wrapper-principal">
                <div class="container">
                <div id="principal">
            <form class="login" method="post" action="bd/logar.php">
                <h3 class="titulo-pequeno">
                    Identifique-se para acessar
                </h3>
                <div class="input-txt-layout">
                    <p>Usuario: </p>
                    <input type="text" name="txt-usuario" value ="" class="input-txt ">
                </div>

                <div class="input-txt-layout margin-bottom-2">
                    <p>Senha:</p>
                    <input type="password" name="txt-senha" value ="" class="input-txt">
                </div>

                <h4 class="red-text"><?=$erro?></h4>

                <input type="submit" name="logar-usuarios" value="Entrar" class="botao entrar-aut btn-hover">
                    <a href="home.php" class="botao btn-voltar">Voltar</a>
            </form>
        </div>
                </div>
            </div>
        </section>
    </body>
</html>