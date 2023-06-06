<?php

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    date_default_timezone_set('America/Sao_Paulo');

    $diaAtual = date('Y-m-d');
    $status_pagamento = (String)"";
    $status_os = (String)"";
    $transporte = "taxi.png";

    if(isset($_POST['btn-dia-selecionado'])){

        $diaAtual = $_POST['date-monitoramento'];

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Petzone</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <link rel="shortcut icon" href="./icon/favicon.ico" type="image/x-icon">
        <script>
             $(document).ready(function(){
                $('.transporteInfo').click(function(){
                    $('#container-modal-ordem').css({
                        visibility:'visible',
                        opacity:'1',
                        zIndex:'999'
                    });
                });
                $('#close-modal').click(function(){
                    $('#container-modal-ordem').css({
                        visibity:'hidden',
                        opacity:'0',
                        zIndex:'-5'
                    });
                });
            });

            function visualizarTransporte(idordem){
                $.ajax({
                    type:"POST",
                    url:"modalOrdem.php",
                    data:{
                        modo:"visualizar",
                        id:idordem,
                    },
                    success: function(dados){
                        $('#modal-ordem').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
    <?php
        require_once('modulo/menu.php');
    ?>
        <div id="container-modal-ordem">
            <img src="icon/cancel.png" alt="fechar" id="close-modal">
            <!-- <img src="icon/cancel.png" alt="fechar" id="close-modal"> -->
            <div id="modal-ordem">
                
            </div>
        </div>

        <div class="pagina-inicial-transporte-consulta flex-align-end">
            <div class="tranportes-confirmados tabela-grande">
                <div class="linha">
                    <h3>ORDENS DE SERVIÇOS DO DIA</h3>
                    <form action="monitoramento.php" method="post" class="selecione-data">
                        <h6> Selecione data </h6>
                        <img src="icon/calendar.png" alt="calendario">
                        <input type="date" value="<?=$diaAtual?>" name="date-monitoramento" id="slt-data-monitoramento">
                        <button type="submit" name="btn-dia-selecionado">
                            <img src="icon/lupa.png" alt="lupa">
                        </button>
                    </form>
                </div>
                <div class="tabela-transportes tabela-grande">
                    <div class="linha-tabela-ordem-servico azul-marinho">
                        <div class="coluna-tabela-ordem-servico">
                            CLIENTE
                        </div>
                        <div class="coluna-tabela-ordem-servico">
                            ANIMAL
                        </div>
                        <div class="coluna-tabela-ordem-servico">
                            ESPECIE
                        </div>
                        <div class="coluna-tabela-ordem-servico">
                            HORARIO
                        </div>
                        <div class="coluna-tabela-ordem-servico">
                            VALOR
                        </div>
                        <div class="coluna-tabela-ordem-servico-tes">
                            VISUALIZAR
                        </div>
                    </div>

                    <?php

                        $sql = "SELECT ordem_servico.*, animais.nome AS animal, especies.nome AS especie FROM ordem_servico 
                        INNER JOIN animais ON ordem_servico.id_animal = animais.id INNER JOIN especies ON animais.id_especie = 
                        especies.id WHERE ordem_servico.data_ordem = '".$diaAtual."' ORDER BY horario_ordem ASC";

                        $select = mysqli_query($conexao, $sql);

                        while($rsConsulta = mysqli_fetch_array($select)){

                            if($rsConsulta['situacao_pagamento'] == 1)
                                $status_pagamento = "verificado.png";
                            else
                                $status_pagamento = "cancelado.png";
                            

                            if($rsConsulta['situacao'] == "A")
                                $status_os = "ordem-de-servico-aberta";
                            elseif($rsConsulta['situacao'] == "F")
                                $status_os = "ordem-de-servico-fechada";
                            else
                                $status_os = "ordem-de-servico-cancelada";
                            
                    
                    ?>

                    <div class="linha-tabela-ordem-servico txt-black <?=$status_os?>">
                        <div class="coluna-tabela-ordem-servico border-none">
                            <input type="text" value="<?=$rsConsulta['nome_cliente']?>" readonly>
                        </div>
                        <div class="coluna-tabela-ordem-servico border-none">
                            <input type="text" value="<?=$rsConsulta['animal']?>" readonly>
                        </div>
                        <div class="coluna-tabela-ordem-servico border-none">
                            <input type="text" value="<?=$rsConsulta['especie']?>" readonly>
                        </div>
                        <div class="coluna-tabela-ordem-servico border-none">
                            <input type="text" value="<?=$rsConsulta['horario_ordem']?>" readonly>
                        </div>
                        <div class="coluna-tabela-ordem-servico border-none">
                            <input type="text" value="R$ <?=number_format($rsConsulta['total']+$rsConsulta['valor_transporte'],2,',','.')?>" readonly>
                        </div>
                        <div class="coluna-tabela-ordem-servico-tes border-none">
                            <a href="#">
                                <img src="icon/lupa.png" onclick="visualizarTransporte(<?=$rsConsulta['id']?>);" class="transporteInfo" alt="visualizar">
                            </a> 
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