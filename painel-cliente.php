<?php

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    if(isset($_GET['modo']))
        if(strtoupper($_GET['modo']) == 'CLOSE')
            echo("<script>window.close();</script>");
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzone</title>
    <link rel="stylesheet" href="./css/style.css">
    <script>
            $('#imprimir').click(function(){   
                window.open('modalCompras.php', '_blank');
            });
        </script>
</head>
<body class="body-painel-cliente">
    <section class="painel-secao-cliente">
        <div class="wrapper-painel-cliente">
            <div class="container">
            <div>
    <div id="container-modal-compras">
        <div id="modal-compras">

        
        </div>
    </div>
    </div>
    <div class="container-compra">
    <?php
        $sql = "SELECT * FROM clientes WHERE id =".$_GET['idcliente'];
        $select = mysqli_query($conexao, $sql);
        $rsCliente = mysqli_fetch_array($select);


    ?>

    <div class="conteudo-cliente">
        <div class="informacoes-cliente">
            <div class="linha-painel-cliente">
                <div class="info-cliente-item">
                    <div class="img-avatar">
                    <img class="avatar" src="icon/avatar/<?=$rsCliente['avatar']?>" alt="avatar">
                    </div>
                <div class="conteudo-cliente">
                <input type="text" value="<?=$rsCliente['nome']?> - <?=$rsCliente['email']?>" id="nome-cliente" readonly>
                    <h3>Endereço</h3>
                    <h5>CEP: <?=$rsCliente['cep']?> </h5> <h5><?=$rsCliente['logradouro']?> - nº<?=$rsCliente['numero']?></h5>
                    <h5><?=$rsCliente['bairro']?></h5>
                    <h5><?=$rsCliente['cidade']?> - <?=$rsCliente['estado']?></h5>

                    <button class="edit-painel-cliente">
                        <a href="cadastrar-cliente.php?idcliente=<?=$_GET['idcliente']?>&modo=editar">Editar</a>
                    </button>

                    <button class="new-painel-cliente">
                    <?php
                        if(isset($_GET['modo'])){
                    ?>

                    <a href="cadastro-animal.php?idcliente=<?=$rsCliente['id']?>&modo=<?=$_GET['modo']?>">Novo animal</a>
                    
                    <?php
                        }else{
                    ?>
                    <a href="cadastro-animal.php?idcliente=<?=$rsCliente['id']?>">Novo animal</a>
                    <?php
                        }
                    ?>
                </button>
                </div>
                </div>
            </div>

            <div class="conteudo-compras">
            <h1>COMPRAS DO CLIENTE</h1>
                        <div class="info-cliente-compras">

                            <div class="tabela-compra">
                                    <div class="thead-linha">
                                    
                                        <div class="thead-coluna">
                                            Data
                                        </div>

                                        <div class="thead-coluna">
                                            Valor da compra
                                        </div>
                                       
                                        <div class="thead-coluna">
                                            Visualizar
                                        </div>
                                        
                                    </div>

                                    <?php
                                        $count = 0;
                                        $cor = "cor-linha";
                                        $sqlCompra = "SELECT * FROM compra where id_cliente = ".$_GET['idcliente'];
                                        $selectCompras = mysqli_query($conexao, $sqlCompra);

                                        while($rsCompras = mysqli_fetch_array($selectCompras))
                                        {
                                            $count++;

                                            if($count % 2 != 0)
                                            {
                                                $cor = "";
                                            }else
                                            {
                                                $cor = "cor";
                                            }
                                            
                                            $data_compra = explode('-', $rsCompras['data_compra']);
                                            $data_compra = $data_compra[2]."/".$data_compra[1]."/".$data_compra[0];

                                        
                                            // $data_hora_compra = $hora_compra[1]."/".$data_compra[1]."/".$data_compra[0];

                                    ?>
                                        
                                    <div class="linha-tabela-compra <?=$cor?>">
                                        <div class="coluna-tabela-compra">
                                            <?=$data_compra?>
                                        </div>

                                        <div class="coluna-tabela-compra">
                                            R$ <?=number_format($rsCompras['preco_total'],2, ',' , '.')?>
                                        </div>
                                        
                                        <div class="coluna-tabela-compra">
                                            <a target="_blank" href="modalCompras.php?idcompra=<?=$rsCompras['id']?>&idcliente=<?=$_GET['idcliente']?>" id="imprimir">
                                                <img src="./icon/lupa.png" alt="read" class="detalhes-compra">
                                            </a>
                                        </div>
                                    </div>
                                    <?php

                                        }
                                    
                                    ?>
                            </div> 
                            
                            
                        </div>
                        <div class="numero-compras">
                            Compras: <?=$count?>
                        </div>

                        <div class="numero-compras">
                            <a href="bd/matarSessoes.php">
                                SAIR
                            </a>
                        </div>
                        
                    </div>

                        <div class="conteudo-animais-painel-cliente">
                        <h1>ANIMAIS CADASTRADOS</h1>

<div class="tabela-compra">
    
    <div class="thead-linha">
        
        <div class="thead-coluna">
            Nome
        </div>
        <div class="thead-coluna">
            Espécie
        </div>
        <div class="thead-coluna">
            Opções
        </div>
        
    </div>
    <?php
        $count = (int) 0;

        $sql = "select animais.*, especies.nome as especie from
        animais inner join especies on animais.id_especie = especies.id where animais.id_dono = ".$_GET['idcliente']." and animais.ativado = 1";
        
        
        $select = mysqli_query($conexao, $sql);

        while($rsConsulta = mysqli_fetch_array($select)){
            $count +=1;

            if($count % 2 == 0)
                $cor = "cor";
            else
                $cor = "";

        
    ?>
    <div class="linha-tabela-compra <?=$cor?>">
        <div class="coluna-tabela-compra">
            <?=$rsConsulta['nome']?>
        </div>
        <div class="coluna-tabela-compra">
            <?=$rsConsulta['especie']?>
        </div>
        <div class="coluna-tabela-compra">
            <a href="bd/deletar.php?modo=deletaranimal&id=<?=$rsConsulta['id']?>&idcliente=<?=$_GET['idcliente']?>">
                <img src="./icon/cancel.png" alt="delete">
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
    </div>

    </div>
            </div>
        </div>
    </section>
</body>
</html>