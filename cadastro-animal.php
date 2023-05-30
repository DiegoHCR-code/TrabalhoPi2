<?php

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $nome_dono = (String)"";
    $contato_dono = (String)"";
    $nome_animal = (String)"";

    if(isset($_GET['idcliente'])){

        $link = (String)"bd/cadastrar-animal.php?idcliente=".$_GET['idcliente'];

        $_SESSION['id'] = $_GET['idcliente'];

        if(isset($_GET['modo']))
            $link = "bd/cadastrar-animal.php?idcliente=".$_GET['idcliente']."&modo=".$_GET['modo'];

    }elseif(isset($_GET['idos'])){

        $link = "bd/cadastrar-animal.php?idos=".$_GET['idos'];
        
        $sql = "SELECT ordem_servico.*, animais.nome_dono AS dono, animais.contato_dono AS contatodono, animais.nome AS nomeanimal FROM
        ordem_servico INNER JOIN animais ON ordem_servico.id_animal = animais.id WHERE ordem_servico.id = ".$_GET['idos'];

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            $nome_dono = $rsConsulta['dono'];
            $contato_dono = $rsConsulta['contatodono'];
            $nome_animal = $rsConsulta['nomeanimal'];
        }

    }elseif(isset($_GET['idtransporte'])){

        $link = (String)"bd/cadastrar-animal.php?idtransporte=".$_GET['idtransporte'];

        $sql = "SELECT transporte_animal.*, animais.nome_dono AS nomedono, animais.contato_dono AS contatodono
        FROM transporte_animal INNER JOIN animais ON transporte_animal.id_animal = animais.id WHERE transporte_animal.id_transporte = ".$_GET['idtransporte'];

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){

            $nome_dono = $rsConsulta['nomedono'];
            $contato_dono = $rsConsulta['contatodono'];

        }

    }

    $cor_predominante_position = (String)"";
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Petzone</title>
        <link rel="stylesheet" href="./css/style.css">
        <script src="js/modulo.js"></script>
        <script src="js/jquery.js"></script>
        <script src="./painel-produtos/js/toggle-menu.js"></script>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
    </head>
    <body class="body-cadastro-animal">
            <?php
                require_once('./modulo/menu.php');
            ?>
    <section class="cadastro-animal">
        <div class="wrapper-cadastro-animal">
            <div class="container">
            <div class="pagina-inicial-atendimento">
            <div class="container-atendimento">
                <form class="fomulario-cadastro-animal" method="POST" action="<?=$link?>">
                    <div class="titulo-animal">
                        <h1>Cadastrar animal</h1>
                    </div>

                    <div class="info-animal">

                        <?php

                            if(!isset($_GET['idcliente'])){
                                $cor_predominante_position = "topCor";
                        ?>

                        <div class="linha">
                            <h5>
                                Nome do Dono
                            </h5>
                            <input type="text" name="txt-animal-nome-dono" onkeypress="return validarEntrada(event,'numeric');" value="<?=$nome_dono?>" id="animal-nome-dono">
                        </div>
                        <div class="linha">
                            <h5>
                                Numero para contato
                            </h5>
                            <input type="text" onkeypress="return mascaraFone(this,event);" name="txt-animal-contato-dono" value="<?=$contato_dono?>" id="animal-contato-dono" class="larguraPequeno">
                        </div>
                        <?php
                        
                            }    

                        ?>

                        <div class="linha">
                            <h6>
                                Nome do animal
                            </h6>
                            <input type="text" value="<?=$nome_animal?>" onkeypress="return validarEntrada(event,'numeric');" name="txt-animal-nome" id="animal-nome">
                        </div>

                        <div class="linha-noflex">
                            <div class="coluna">
                                <h6>
                                    Idade
                                </h6>
                                <input type="number" name="txt-animal-idade" id="animal-idade">
                            </div>
                            <div class="coluna-right">
                                <h6>
                                    Porte
                                </h6>
                                <select name="slt-porte-animal" id="porte-animal">
                                    <option value="">Selecione</option>
                                    <?php
                                        $conexao = conexaoMysql();

                                        $sql = "select * from porte";

                                        $select = mysqli_query($conexao, $sql);

                                        while($rsPorte = mysqli_fetch_array($select)){
                                    ?>

                                    <option value="<?=$rsPorte['id']?>"><?=$rsPorte['nome']?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="linha-noflex margem-bottom-grande">
                            <div class="coluna">
                                <h6>
                                    Temperamento
                                </h6>
                                <select name="slt-temperamento-animal" id="temperamento-animal">
                                    <option value="">Selecione</option>
                                    <?php
                                        $conexao = conexaoMysql();

                                        $sql = "select * from temperamentos";

                                        $select = mysqli_query($conexao, $sql);

                                        while($rsTemperamento = mysqli_fetch_array($select)){
                                    ?>

                                    <option value="<?=$rsTemperamento['id']?>"><?=$rsTemperamento['nome']?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="coluna-cor">
                                <h6>
                                    Cor predominante
                                </h6>
                                <div class="lista-cores <?=$cor_predominante_position?>">
                                    <?php
                                    $conexao = conexaoMysql();

                                    $sql = "select * from cor_predominante";

                                    $select = mysqli_query($conexao, $sql);

                                    while($rsCor = mysqli_fetch_array($select)){

                                    ?>
                                    <label class="cor_predominante" for="<?=$rsCor['id']?>">
                                        <div class="selected_cor" style="background-color:<?=$rsCor['nome']?>;"></div>
                                    </label>
                                    <input value="<?=$rsCor['id']?>" type="radio" name="txt-cor" id="<?=$rsCor['id']?>">
                                    <?php
                                    }                                    
                                    ?>
                                </div>
                                

                            </div>
                            

                            
                        </div>


                        <div class="linha-noflex">
                            <div class="coluna">
                                <h6>
                                    Espécie
                                </h6>
                                <select name="slt-especie-animal" id="especie-animal">
                                    <option value="">Selecione espécie</option>
                                    <?php
                                        $conexao = conexaoMysql();

                                        $sql = "select * from especies";

                                        $select = mysqli_query($conexao, $sql);

                                        while($rsEspecie = mysqli_fetch_array($select)){
                                    ?>

                                    <option value="<?=$rsEspecie['id']?>"><?=$rsEspecie['nome']?></option>

                                    

                                    <?php
                                        }
                                    ?>

                                </select>
                            </div>
                            <div class="coluna-right">
                                <h6>
                                    Raça
                                </h6>
                                <select name="slt-raca-animal" id="raca-animal">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="linha">
                            <input type="submit" value="CADASTRAR" class="botao center" name="btn-cadastrar-animal">
                        </div>
                        
                    </div>
                    <div class="doenca-animal">
                        <div class="head-doencas center">
                            <h1>Doenças do animal</h1>
                        </div>
                        <div class="lista-doencas center">
                            <?php
                                $sql = "select * from doencas";
                                $select = mysqli_query($conexao, $sql);
                                
                                while($rsDoencas = mysqli_fetch_array($select))
                                {
                            ?>
                            <div class="linha">
                                <input type="checkbox" name="checklist[]" value="<?=$rsDoencas['id']?>">

                                <h6><?=$rsDoencas['nome']?></h6>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                    

                </form>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/cep.js"></script>
        <script>
            //Combo box para popular o select das raças de acordo com a espécie selecionada
            $('#especie-animal').on("change",function(){
                var idEspecie = $('#especie-animal').val();
                
                $.ajax({
                    url:'selecioneraca.php',
                    type:'POST',
                    data:{id:idEspecie},
                    beforeSend: function(){
                        $('#raca-animal').css({display:'block'});
                        $('#raca-animal').html("Carregando...");
                    },
                    success: function(data){
                        $('#raca-animal').css({display:'block'});
                        $('#raca-animal').html(data);
                    },
                    error: function(data){
                        $('#raca-animal').css({display:'block'});
                        $('#raca-animal').html("Houve um erro ao carregar");
                    }
                });
            });
            
        </script>
            </div>
        </div>
    </section>
    </body>
</html>