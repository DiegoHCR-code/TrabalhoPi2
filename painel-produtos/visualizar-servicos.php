<?php
    require_once('../bd/conexao.php');
    require_once('modulos/verificar-status.php');
    
    $conexao = conexaoMysql();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzone</title>
    <link rel="stylesheet" href="css/painel.css">
        <link rel="stylesheet" href="css/reset.css">
        <script src="js/jquery.js"></script>
        <script src="js/toggle-menu.js"></script>
        <script>
            //Jquery para abrir modal
            $(document).ready(function(){
                $('.visualizar').click(function(){
                    $('#container-modal').css({
                        visibility:'visible',
                        opacity:'1',
                        zIndex:'999'
                    });
                });
            });

            //Ajax para carregar informações do produto na modal
            function visualizarDados(idItem){
                $.ajax({
                    type:"POST",
                    url:"modalProdutos.php",
                    data:{
                        modo:'visualizar-servico',
                        id:idItem
                    },
                    success: function(dados){
                        $('#modal').html(dados);
                    }
                });
            }
        </script>
        <link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
</head>
<body>
<div id="container-modal">
            <div id="modal">
            
                
            </div>
        </div>
        <div id="painel-produtos">
            <?php
                require_once('modulos/menu.php');
            ?>
            <div class="auxiliar"></div>
            <div class="home-painel">
                <div class="container-visualizar">
                    <div class="linha">
                        <div>
                            <img src="img/pet.png" alt="home">
                        </div>
                    </div>
                    <h3 class="titulo">
                        SERVIÇOS
                    </h3>
                    <h2 class="empresa-nome">
                        Petzone
                    </h2>
                    <div class="tabela">
                        <div class="linha-head">
                            <div class="coluna-head">
                                Cód
                            </div>
                            <div class="coluna-head">
                                Nome
                            </div>
                            <div class="coluna-head">
                                Preço
                            </div>
                
                            <div class="coluna-head">
                                Opções
                            </div>
                        </div>

                        <?php
                            $count = (int)0;
                            $cor = "";
                            $atencao = "";
                            $sql="SELECT * FROM servicos WHERE ativado = 1";

                            $select = mysqli_query($conexao, $sql);

                            while($rsConsulta = mysqli_fetch_array($select)){
                            $count ++; 
                            if($count % 2 == 0){

                                $cor = "azul-bg";
                                
                            }else{

                                $cor = "";

                            }

                            
                            
                        ?>

                        <div class="linha-tabela <?=$cor?>">
                            <div class="coluna-tabela">
                                <?=$rsConsulta['id']?>
                            </div>
                            <div class="coluna-tabela">
                                <?=$rsConsulta['nome']?>
                            </div>
                            <div class="coluna-tabela">
                                R$<?=number_format($rsConsulta['preco'], 2, ',', '.')?>
                            </div>
                            
                            <div class="coluna-tabela">
                                <a onclick="return confirm('Deseja realmente excluir esse servico?')" href="../bd/deletar.php?modo=deletarservico&id=<?=$rsConsulta['id']?>">
                                    <img src="img/cancel2.png" alt="delete">
                                </a>
                                
                                    <img src="img/search2.png" alt="buscar" class="visualizar" onclick="visualizarDados(<?=$rsConsulta['id']?>);">
                                
                                <a href="cadastrar-servicos.php?modo=editar&id=<?=$rsConsulta['id']?>">
                                    <img src="img/edit.png" alt="editar">
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
</body>
</html>