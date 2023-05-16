<?php
    require_once('bd/conexao.php');
    require_once('modulo/verificar-status-user.php');
    
    $conexao = conexaoMysql();

    $nome = (String) "";
    $login = (String) "";
    $botao = (String) "CADASTRAR";

    if(isset($_GET['modo'])){
        if(strtoupper($_GET['modo']) == "EDITAR"){

            $sql = "SELECT * FROM usuarios WHERE id = ".$_GET['id'];

            $select = mysqli_query($conexao, $sql);

            if($rsEditar = mysqli_fetch_array($select)){
                
                $_SESSION['id'] = $rsEditar['id'];
                
                $nome = $rsEditar['nome'];
                $login = $rsEditar['username'];
                $botao = "EDITAR";

            }
        }
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
    <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
</head>
<body class="body-criar-usuario">
    <section class="criar-usuario">
        <div class="wrapper-usuario">
            <div class="container">
            <div class="botoes-sair-e-voltar" style="display: flex; justify-content: end; margin-bottom: 20px;">
            <div class="logout topminor">
                <a href="home.php">
                    <img src="icon/back.png" alt="voltar" class="img-voltar">
                </a>
            </div>
            <div class="logout">
                <a href="bd/logout.php">
                    <img src="icon/logout.png" alt="sair" style="width:50px; margin-left: 20px;">
                </a>
            </div>
            </div>
            <div class="home-painel">
        <div class="container-cadastro-produto">
            <div>
                <img src="icon/user.png" alt="icone de usuario">
            </div>
            <h1>Cadastrar novo usuário</h1>
            <h2>Petzone</h2>
            <form action="bd/cadastrar-usuario.php" method="post" class="formulario-produto">
                <div class="container-form">
                    <div class="campo-form">
                        <h4>Nome</h4>
                        <input type="text" class="cadastro-cliente" name="txt-nome-usuario" value="<?=$nome?>" required>
                    </div>
                    <div class="campo-form">
                        <h4>Login</h4>
                        <input type="text" class="cadastro-cliente" name="txt-login" value="<?=$login?>" required>
                    </div>
                    <div class="campo-form">
                        <h4>Senha</h4>
                        <input type="text" class="cadastro-cliente" name="txt-senha" value="" required>
                    </div>

                    <div class="form-botao">
                        <input type="submit" value="<?=$botao?>" class="botao-produto" name="btn-cadastrar-usuario">
                    </div>
                </div>
            </form>
        </div>
        <div class="container-cadastro-produto">
            <div>
                <img src="icon/user.png" alt="Icone de usuario">
            </div>
            <h1>Usuários</h1>
            <h2>Petzone</h2>
            <div class="tabela">
                <div class="coluna-head">Nome</div>
                <div class="coluna-head">Login</div>
                <div class="coluna-head">Opções</div>
            </div>
            <?php
            
            $sql = "SELECT * FROM usuarios";

            $select = mysqli_query($conexao, $sql);

            while($rsConsulta = mysqli_fetch_array($select)){

            
            ?>
            <div class="linha-tabela">
                <div class="coluna-tabela">
                    <?=$rsConsulta['nome']?>
                </div>
                <div class="coluna-tabela">
                    <?=$rsConsulta['username']?>
                </div>
                <div class="coluna-tabela">
                    <a onclick="return confirm('Deseja realmente excluir esse usuario?')" href="bd/deletar.php?modo=deletarusuario&id=<?=$rsConsulta['id']?>">
                        <img src="painel-produtos/img/cancel2.png" alt="delete">
                    </a>

                    <a href="criar-usuario.php?modo=editar&id=<?=$rsConsulta['id']?>">
                        <img src="painel-produtos/img/edit.png" alt="editar">
                    </a>
                </div>
            </div>

            <?php    
            }
            ?>
        </div>
    </div>
            </div>
        </div>
    </section>
</body>
</html>