<?php

    require_once('conexao.php');
    $conexao = conexaoMysql();

    if(isset($_POST['btn-confirmar-os'])){

        $opcaoPagamento = $_POST['rdoPagar'];
        $valor_total = number_format($_POST['txt-valor-total'], 2, '.',' ');

        if($opcaoPagamento != 0){

            $forma_pagamento = $_POST['slt-formapagamento'];

            $sql = "UPDATE ordem_servico SET situacao_pagamento = 1, id_formapagamento = ".$forma_pagamento.", total = ".$valor_total." WHERE id = ".$_GET['idos'];

            if(mysqli_query($conexao, $sql))
                header('location: ../os.php?idos='.$_GET['idos'].'&pagamento='.$opcaoPagamento);
            else
                echo("erro ao executar script");
                echo($sql);
        }else{
            $sql = "UPDATE ordem_servico SET total = ".$valor_total." WHERE id = ".$_GET['idos'];

            if(mysqli_query($conexao, $sql))
                header('location: ../os.php?idos='.$_GET['idos'].'&pagamento='.$opcaoPagamento);
            else
                echo("erro ao executar script");
        }
    }

?>