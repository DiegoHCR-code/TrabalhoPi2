<?php
require_once('../bd/conexao.php');
require_once('modulos/verificar-status.php');

$conexao = conexaoMysql();

$nome = (String)"";
$preco = (String)"";
$descricao = (String)"";
$botao = (String)"CADASTRAR";

if(isset($_GET['modo'])){
    if(strtoupper($_GET['modo']) == 'EDITAR'){
        // session_start();
        
        $id = $_GET['id'];

        $_SESSION['id']=$id;

        $sql="SELECT * FROM servicos WHERE id = ".$id;

        $selectProdutos = mysqli_query($conexao, $sql);

        $rsProduto = mysqli_fetch_array($selectProdutos);

        $nome = $rsProduto['nome'];
        $preco = explode(".", $rsProduto['preco']);
        $preco = $preco[0].",".$preco[1];
        $descricao = $rsProduto['descricao'];
        $botao = "EDITAR";

    }
}
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
        <script src="../js/jquery.js"></script>
        <script>
            
        </script>
    </head>
    <body>
        <div class="painel-produtos">
            <?php
                require_once('modulos/menu.php');
            ?>
            <div class="auxiliar"></div>
            <div class="home-painel alturacentervh">
                <div class="container-cadastro-produto alturaPadrao azul-bg">
                    <div class="linha">
                        <div>
                            <img src="img/pet.png" alt="home">
                        </div>
                    </div>
                    <h3 class="titulo">
                        Cadastrar serviço
                    </h3>
                    <h2 class="empresa-nome">
                        Petzone
                    </h2>
                    <form action="../bd/inserir-servico.php" method="post" class="formulario-produto">
                        <div class="container-form">
                            <div class="linha-form">
                                <h4>
                                    Nome
                                </h4>
                                <input type="text" id="servico-nome" name="txt-nome-servico" value="<?=$nome?>">
                            </div>

                            <div class="linha-form">
                                <h4>
                                    Preço
                                </h4>
                                <input type="text" id="servico-preco" name="txt-preco-servico" value="<?=$preco?>">
                            </div>

                            <div class="linha-form-txtarea">
                                <h4>
                                    Descrição
                                </h4>
                                <textarea type="text" id="servico-desc" name="txt-desc-servico"><?=$descricao?></textarea>
                            </div>

                            <div class="linha-form-botao">
                                <input type="submit" value="<?=$botao?>" class="botao-produto" name="btn-cadastrar-servico">
                            </div>
                        </div>
                        
                    </form>
                
                </div>
            </div>
        </div>
    </body>
</html>