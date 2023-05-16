<?php
    require_once('bd/conexao.php');
    $conexao = conexaoMysql();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Petzone</title>
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
    </head>
    <body class="body-config-animais">
        
            <?php
                require_once('./modulo/menu.php');
            ?>
    <section class="config-animals-secao">
        <div class="wrapper-config-animais-secao">
        <div class="pagina-inicial">
            <div class="container">
                <?php
                    require_once('modulo/header.php');
                ?>
                <nav id="nav">
                    
                </nav>
                
                <section id="confi-animais">
                    <!-- <h1 class="titulo texto-center">
                        Configurações de animais
                    </h1> -->
                    <div class="config-animais margem-media center">
                    <h1 class="titulo texto-center">
                        Configurações de animais
                    </h1>
                        <h1 class="texto texto-center">Cadastre aqui todas as caracteristicas que os animais poderão ter no cadastro de animal.</h1>

                        <form method="POST" action="bd/inserir-conf.php" class="linha-flex-row">
                            
                            <input type="text" name="txt-cadastro-doenca" class="input-txt" placeholder="Doença">
                            <button type="submit" class="btn-add"></button>
                        </form>
                        <form method="POST" action="bd/inserir-conf.php" class="linha-flex-row">
                            
                            <input type="text" name="txt-cadastro-especie" class="input-txt" placeholder="Espécie">
                            <button type="submit" class="btn-add"></button>
                        </form>
                        <form method="POST" action="bd/inserir-conf.php" class="linha-flex-row ">
                            
                            <input type="text" name="txt-cadastro-porte" class="input-txt" placeholder="Porte físico">
                            <button type="submit" class="btn-add"></button>
                        </form>
                        <form method="POST" action="bd/inserir-conf.php" class="linha-flex-row">
                            
                            <input type="text" name="txt-cadastro-temperamento" class="input-txt" placeholder="Temperamento">
                            <button type="submit" class="btn-add"></button>
                        </form>
                        <form method="POST" action="bd/inserir-conf.php" class="linha-flex-row ">
                            
                            <input type="color" name="color-cadastro-cor" class="input-txt color-botaozin">
                            <button type="submit" class="btn-add"></button>
                        </form>
                    </div>

                    <!-- <h1 class="titulo texto-center">cadastre uma nova raça</h1> -->
                    <div class="form-raca center">
                        <h1 class="titulo texto-center">Cadastre uma nova raça</h1>
                        <form action="bd/inserir-conf.php" method="POST">
                            <div class="linha-flex-row">
                                Raça
                                <input type="text" name="txt-cadastro-raca" class="input-txt">
                                
                            </div>
                            <div class="linha-flex-row">
                                Espécie
                                <select name="slt-especies" class="input-txt">
                                    <option value="">Especie</option>
                                    <?php

                                        $sql_especie_cadastro = "select * from especies where ativado = 1";

                                        $select_especie_cadastro = mysqli_query($conexao, $sql_especie_cadastro);

                                        while($rsCadastroEspecie = mysqli_fetch_array($select_especie_cadastro))
                                        {
                                    
                                    ?>
                                    <option value="<?=$rsCadastroEspecie['id']?>"><?=$rsCadastroEspecie['nome']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                
                            </div>
                            <div class="linha-flex-row">
                                
                                <input type="submit" name="btn-raca" class="botao btn-filtro" value="CADASTRAR">
                                
                            </div>
                        </form>

                    </div>
                </section>
                <div class="tabelas-de-visualizacao-config">
                    <h1 class="titulo"> Visualização de todas as caracteristicas cadastradas </h1>
                    <!-- TABELA PEQUENA -->
                    <div class="tabela-de-exibicao-small">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna">
                                Doenças
                            </div>
                            
                            <div class="tabela-coluna">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php

                            $sql_doenca = "select * from doencas where ativado = 1";
                            $select_doenca = mysqli_query($conexao, $sql_doenca);
                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaDoenca = mysqli_fetch_array($select_doenca))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>      
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna">
                                <?=$rsConsultaDoenca['nome']?>  
                            </div>
                        
                            <div class="tabela-coluna ">
            
                                <a  onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletardoenca&id=<?=$rsConsultaDoenca['id']?>">
                                    <img src="./icon/cancel.png" alt="delete">
                                </a>
                                
                            </div>
                        </div>
                        <?php

                            }

                        ?>
                    </div>
                    <!-- TABELA PEQUENA ACABA AQUi -->


                    <!-- TABELA PEQUENA -->
                    <div class="tabela-de-exibicao-small">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna">
                                Espécies
                            </div>
                            
                            <div class="tabela-coluna">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php

                            $sql_especie = "select * from especies where ativado = 1";
                            $select_especie = mysqli_query($conexao, $sql_especie);
                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaEspecie = mysqli_fetch_array($select_especie))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>   
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna">
                                <?=$rsConsultaEspecie['nome']?> 
                            </div>
                        
                            <div class="tabela-coluna">
            
                                <a onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletarespecie&id=<?=$rsConsultaEspecie['id']?>">
                                    <img src="./icon/cancel.png" alt="delete">
                                </a>
                                
                            </div>
                        </div>
                        <?php

                            }

                        ?>
                
                    </div>
                    <!-- TABELA PEQUENA ACABA AQUi -->



                    <!-- TABELA PEQUENA -->
                    <div class="tabela-de-exibicao-small">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna">
                                Porte físico
                            </div>
                            
                            <div class="tabela-coluna">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php

                            $sql_porte = "select * from porte where ativado = 1";
                            $select_porte = mysqli_query($conexao, $sql_porte);
                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaPorte = mysqli_fetch_array($select_porte))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>   
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna">
                                <?=$rsConsultaPorte['nome']?>
                            </div>
                        
                            <div class="tabela-coluna">
            
                                <a onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletarporte&id=<?=$rsConsultaPorte['id']?>">
                                    <img src="./icon/cancel.png" alt="delete">
                                </a>
                                
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                    <!-- TABELA PEQUENA ACABA AQUi -->



                    <!-- TABELA PEQUENA -->
                    <div class="tabela-de-exibicao-small">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna">
                                Temperamento
                            </div>
                            
                            <div class="tabela-coluna">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php

                            $sql_temperamento = "select * from temperamentos where ativado = 1";
                            $select_temperamento = mysqli_query($conexao, $sql_temperamento);
                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaTemperamento = mysqli_fetch_array($select_temperamento))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>  
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna">
                                <?=$rsConsultaTemperamento['nome']?>
                            </div>
                        
                            <div class="tabela-coluna">
            
                                <a onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletartemperamento&id=<?=$rsConsultaTemperamento['id']?>">
                                    <img src="./icon/cancel.png" alt="delete">
                                </a>
                                
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                    </div>
                    <!-- TABELA PEQUENA ACABA AQUi -->


                    <!-- TABELA PEQUENA -->
                    <div class="tabela-de-exibicao-small">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna">
                                Cor Predominante
                            </div>
                            
                            <div class="tabela-coluna">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php

                            $sql_cor = "select * from cor_predominante where ativado = 1";
                            $select_cor = mysqli_query($conexao, $sql_cor);
                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaCor = mysqli_fetch_array($select_cor))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>  
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna ">
                                <div class="color" style="background-color:<?=$rsConsultaCor['nome']?>;"></div>  
                            </div>
                        
                            <div class="tabela-coluna texto-center">
            
                                <a onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletarcor&id=<?=$rsConsultaCor['id']?>">
                                    <img src="./icon/cancel.png" alt="delete">
                                </a>
                                
                            </div>
                        </div>
                        <?php
                            }
                        ?>

                    </div>
                    <!-- TABELA PEQUENA ACABA AQUi -->
                    
                </div>


                
                <div class="visualizacao-raca">
                <div class="filtros center">
                    <form action="config-animais.php" method="get" class="filtro-linha">
                        <div class="input-txt-layout2">
                            Pesquise raça por nome:

                            <input type="text" name="nome-raca" class="input-txt border-radius">

                            <button type="submit" name="btn-raca" class="btn-filtro">
                                Buscar
                            </button>
                        </div>
                        <div class="input-txt-layout2">
                            Filtrar por espécie:
                            <select name="slt-categorias" id="categorigas" class="select">
                                <option value="">
                                    Selecione Espécie
                                </option>

                                <?php
                                    $sql = "select * from especies where ativado = 1";
                                    $select = mysqli_query($conexao, $sql);

                                    while($rsEspecie = mysqli_fetch_array($select)){
                                ?>

                                    <option value="<?=$rsEspecie['id']?>">
                                        <?=$rsEspecie['nome']?>
                                    </option>

                                <?php
                                    }
                                ?>
                            </select>
                            <button type="submit" name="btn-especie" class="btn-filtro">
                                    Buscar
                            </button>
                        </div>
                    </form>
                    
                    <div class="tabela-de-exibicao-mid center">
                        <div class="tabela-cabecalho">
                            <!-- CABEÇALHO DA TABELA -->
                            <div class="tabela-coluna texto-center">
                                Raça
                            </div>

                            <div class="tabela-coluna texto-center">
                                Espécie
                            </div>
                            
                            <div class="tabela-coluna texto-center">
                                Opções
                            </div>
                        </div>
                        <!-- REGISTROS VINDOS DO BANCO -->
                        <?php


                            if(isset($_GET['btn-raca'])){

                                $nomeRaca = str_replace("'", " ", $_GET['nome-raca']);

                                $sql_raca = "select racas.*, especies.nome as especie from racas inner join especies on racas.id_especie = especies.id where racas.ativado = 1
                                and racas.nome like '%".$nomeRaca."%' ";

                            }elseif(isset($_GET['btn-especie'])){

                                $especie = $_GET['slt-categorias'];

                                $sql_raca = "select racas.*, especies.nome as especie from racas inner join especies on racas.id_especie = especies.id where racas.ativado = 1
                                and especies.id =".$especie;

                            }else{

                                $sql_raca = "select racas.*, especies.nome as especie from racas inner join especies on racas.id_especie = especies.id where racas.ativado = 1";

                            }

                            
                            
                            $select_raca = mysqli_query($conexao, $sql_raca);

                            $count = 1;
                            $cor = (String) "";

                            while($rsConsultaRaca = mysqli_fetch_array($select_raca))
                            {
                                $count +=1;

                                if($count % 2 == 0)
                                    $cor = "cor-linha";
                                else
                                    $cor = "";
                        ?>  
                        <div class="tabela-linha <?=$cor?>">
                            <div class="tabela-coluna texto-center">
                                <?=$rsConsultaRaca['nome']?>  
                            </div>

                            <div class="tabela-coluna texto-center">
                                <?=$rsConsultaRaca['especie']?> 
                            </div>
                        
                            <div class="tabela-coluna texto-center">
                                
                                <a onclick="return confirm('tem certeza que deseja deletar esse registro?'); " href="bd/deletar.php?modo=deletarraca&id=<?=$rsConsultaRaca['id']?>">
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
    </section>
        
        <script src="js/jquery.js"></script>
        <script src="js/ancora.js"></script>
        <script src="js/scroll.js"></script>
    </body>
</html>