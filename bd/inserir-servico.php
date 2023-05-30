<?php
    require_once('conexao.php');
    $conexao = conexaoMysql();
    if(!isset($_SESSION))
    {
        session_start();
    }

    if(isset($_POST['btn-cadastrar-servico']))
    {

        $precoFormatado = explode(",", $_POST['txt-preco-servico']);
        $precoFormatado = $precoFormatado[0].".".$precoFormatado[1];

        if(strtoupper($_POST['btn-cadastrar-servico']) == "CADASTRAR")
        {
            $sql = "insert into servicos (nome, preco, descricao) values ('".$_POST['txt-nome-servico']."', '".$precoFormatado."','".$_POST['txt-desc-servico']."')";
            
            if(mysqli_query($conexao, $sql))
            {
                header('location: ../painel-produtos/cadastrar-servicos.php');
            }else
            {
                echo($sql);
            }
        }if(strtoupper($_POST['btn-cadastrar-servico']) == "EDITAR")
        {
            $id = $_SESSION['id'];

            $sql = "update servicos set nome = '".$_POST['txt-nome-servico']."', preco = ".$precoFormatado.", descricao = '".$_POST['txt-desc-servico']."' where id = ".$id;

            if(mysqli_query($conexao, $sql))
            {
                header('location: ../painel-produtos/visualizar-servicos.php');
            }else
            {
                echo($sql);
            }
        }
    }
?>