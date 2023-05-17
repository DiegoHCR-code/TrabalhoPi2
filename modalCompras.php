<?php

$cliente = (String)"Cliente não cadastrado";
$idCliente = (int)0;
$link = (String) "home.php";

if(isset($_GET['idcompra'])){

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $idCompra = $_GET['idcompra'];

    if(isset($_GET['idcliente']) && $_GET['idcliente'] != ""){

        
        $link = "painel-cliente.php?idcliente=".$_GET['idcliente'];

        $sql = "SELECT clientes.nome AS nome, clientes.id AS idcliente, compra.* FROM clientes
        INNER JOIN compra ON clientes.id = compra.id_cliente WHERE compra.id = ".$idCompra;

    }else{

        $sql = "SELECT compra.* FROM compra WHERE id = ".$idCompra;

    }

    $select = mysqli_query($conexao, $sql);

    if($rsConsulta = mysqli_fetch_array($select))
    {
        
        if(isset($_GET['idcliente']) && $_GET['idcliente'] != ""){
            $cliente = $rsConsulta['nome'];
            $idCliente = $rsConsulta['idcliente'];
        }

        $carrinho = $rsConsulta['id_carrinho'];
        $dataFormat = explode('-', $rsConsulta['data_compra']);
        $data = $dataFormat[2]."/".$dataFormat[1]."/".$dataFormat[0 ];
        $hora = $rsConsulta['horario_compra'];
        $valor = number_format($rsConsulta['preco_total'],2,',','.');

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
        <title>Petzone</title>
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <script>

            //Abre a tela de impressao

            $(document).ready(function(){
                $('#imprimirComprovante').click(function(){
                    window.print();
                })
            });
        </script>
    </head>
    <body>
        <div id="imprimirComprovante">
            <img src="icon/printer.png" alt="voltar">
        </div>

        <div class="voltar">
            <a href="<?=$link?>">
                <img src="icon/left-curve-arrow.png" alt="voltar">
            </a>
        </div>
        <div class="informacoes-compra">
            <div class="container-modal-compra">
                <div class="linha-modal">
                    <h1>
                        <?=$cliente?>
                    </h1>
                </div>
                <div class="linha-modal">

                    <h3>DATA: <?=$data?> </h3>

                    <h3>HORA: <?=$hora?> </h3>

                    <h3>VALOR: R$ <?=$valor?> </h3>

                </div>
                
                <div class="tabela-comprados">
                    <div class="comprados-item-head">
                        <div class="col-item-head">
                            NOME
                        </div>
                        <div class="col-item-head">
                            CATEGORIA
                        </div>
                        <div class="col-item-head">
                            QUANTIDADE
                        </div>
                        <div class="col-item-head">
                            VALOR
                        </div>
                    </div>
                    <?php
                    require_once('bd/conexao.php');
                    
                    $sqlProdutos = "SELECT carrinho_produto.*, produtos.nome AS produto, produtos.id_categoria, categoria.nome AS categoria
                    FROM carrinho_produto INNER JOIN produtos ON carrinho_produto.id_produto = produtos.id INNER JOIN categoria ON 
                    produtos.id_categoria = categoria.id WHERE carrinho_produto.id_carrinho =".$carrinho;

                    $selectProdutos = mysqli_query($conexao, $sqlProdutos);
                    $count = 0;
                    $cor = "cor-linha";


                    
                    while($rsProdutos = mysqli_fetch_array($selectProdutos)){

                        $count++;

                        if($count % 2 != 0)
                        {
                            $cor = "";
                        }else
                        {
                            $cor = "cor";
                        }

                        $nomeProdutos = $rsProdutos['produto'];
                        $categoria = $rsProdutos['categoria'];
                        $valorCompra = number_format($rsProdutos['saida_preco'], 2,',','.');
                        $quantidaSaida = $rsProdutos['saida_produto'];

                    ?>
                    <div class="comprados-item <?=$cor?>">
                        <div class="col-item">
                            <?=$nomeProdutos?>
                        </div>
                        <div class="col-item">
                            <?=$categoria?>
                        </div>
                        <div class="col-item">
                            <?=$quantidaSaida?>
                        </div>
                        <div class="col-item">
                            R$ <?=$valorCompra?>
                        </div>
                    </div>
                    <?php
                    
                    }

                    ?>
                    
                </div>
                
            </div>
        </div>
    </body>
</html>
