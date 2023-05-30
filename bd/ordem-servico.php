<?php

    require_once('conexao.php');
    $conexao = conexaoMysql();

    $nome_cliente = (String)"";

    if(isset($_GET['idcliente'])){
        $sql = "INSERT INTO ordem_servico (id_cliente) VALUES (".$_GET['idcliente'].")";

        if(mysqli_query($conexao, $sql))
            header('location: ../consumir-servicos.php?idcliente='.$_GET['idcliente']);
        else
            echo("erro ao executar o script");
    }else{

        $sql = "insert into ordem_servico (nome_cliente) values ('".$nome_cliente."')";

        if(mysqli_query($conexao, $sql))
            header('location: ../consumir-servicos.php');
        else
            echo("erro ao executar o script");
    }

    

?>