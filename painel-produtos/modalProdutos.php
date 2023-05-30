<?php
require_once('modulos/verificar-status.php');

    $id = (int)0;
    $nome = (String)"";
    $preco = (double)0;
    $quantidade = (int)0;
    $imagem = (String)"";
    $categoria = (String)"";
    $fornecedor = (String)"";
    $descricao = (String)"";


    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_POST['modo'])){
        if(strtoupper($_POST['modo']) == 'VISUALIZAR'){

            require_once('../bd/conexao.php');
            $conexao = conexaoMysql();

            $id = $_POST['id'];

            $sql = "SELECT produtos.*,
                    fornecedores.nome AS fornecedor,
                    categoria.nome AS categoria FROM produtos
                    INNER JOIN fornecedores ON produtos.id_fornecedor = fornecedores.id
                    INNER JOIN categoria ON produtos.id_categoria = categoria.id
                    WHERE produtos.id = ".$id;

            $select = mysqli_query($conexao, $sql);

            if($rsVisualizar = mysqli_fetch_array($select)){

                $id = $rsVisualizar['id'];
                $nome = strtoupper($rsVisualizar['nome']);
                $preco = $rsVisualizar['preco'];
                $precoCompra = $rsVisualizar['preco_compra'];
                $imagem = $rsVisualizar['imagem'];
                $categoria = $rsVisualizar['categoria'];
                $descricao = $rsVisualizar['descricao'];

            }else{
                echo($sql);
            }
        }elseif(strtoupper($_POST['modo']) == 'VISUALIZAR-SERVICO'){
            require_once('../bd/conexao.php');
            $conexao = conexaoMysql();

            $id = $_POST['id'];

            $sql = "SELECT * FROM servicos WHERE id =".$id;

            $select = mysqli_query($conexao, $sql);

            if($rsVisualizar = mysqli_fetch_array($select)){

                $id = $rsVisualizar['id'];
                $nome = strtoupper($rsVisualizar['nome']);
                $preco = number_format($rsVisualizar['preco'], 2, ',', '.');
                $descricao = $rsVisualizar['descricao'];

            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>modal</title>
    <script src="js/jquery.js"></script>
    <script>
    $(document).ready(function(){
        $('#botao-fechar').click(function(){
            $('#container-modal').css({
                visibility:'hidden',
                opacity:'0',
                zIndex:'-1'
            });
        });
    });
    </script>
</head>
    <body>
        <?php

            if($imagem != ""){
                
        ?>
        <div class="produto-visualizar">
            <img src="../bd/arquivos/<?=$imagem?>" alt="imagem-produto">
        </div>
        <?php

            }

        ?>
        <div class="informacoes-modal-produto">
            <h1>
                <?=$nome?>
            </h1>
            <h2>
                CÓDIGO: <?=$id?>
            </h2>
            <h2>
                PREÇO: R$ <?=$preco?>
            </h2>
            <?php
                if(strtoupper($_POST['modo']) == 'VISUALIZAR')
                {
            ?>
            <h2>
                PREÇO DE COMPRA R$ <?=$precoCompra?>
            </h2>
            <?php
                }
            ?>
            <h2>
                CATEGORIA: <?=$categoria?> <?php if(strtoupper($_POST['modo']) == 'VISUALIZAR-SERVICO') echo("SERVICOS") ?>
            </h2>
            <div>
                <h2>DESCRIÇÃO:</h2>
                <textarea name="txt-descrica" readonly><?=$descricao?></textarea>
            </div>
        </div>
        <div id="botao-fechar">
            FECHAR
        </div>
    </body>
</html>