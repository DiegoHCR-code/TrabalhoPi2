<?php

require_once('conexao.php');
$conexao = conexaoMysql();

if(isset($_POST['logar-estoque'])){

    $login = $_POST['txt-usuario'];
    $senha = $_POST['txt-senha'];

    $sql = "SELECT * FROM usuarios";

    $select = mysqli_query($conexao, $sql);

    if($rsConsulta = mysqli_fetch_array($select)){

        if($rsConsulta['username'] == $login && $rsConsulta['senha'] == $senha){

            session_start();
            $_SESSION['status'] = "estoque";

            header('location: ../painel-produtos/painel-produtos.php');

        }else
            header('location: ../autenticacao-estoque.php?modo=invalid');
    }
}elseif(isset($_POST['logar-usuarios'])){

    $login = $_POST['txt-usuario'];
    $senha = $_POST['txt-senha'];

    $sql = "SELECT * FROM usuarios";

    $select = mysqli_query($conexao, $sql);

    if($rsConsulta = mysqli_fetch_array($select)){

        if($rsConsulta['username'] == $login && $rsConsulta['senha'] == $senha){

            session_start();

            $_SESSION['status'] = "usuario";

            header('location: ../criar-usuario.php');

        }else
            header('location: ../autenticacao-usuarios.php?modo=invalid');
    }
}elseif(isset($_POST['logar-financeiro'])){

    $login = $_POST['txt-usuario'];
    $senha = $_POST['txt-senha'];

    $sql = "SELECT * FROM usuarios";

    $select = mysqli_query($conexao, $sql);

    if($rsConsulta = mysqli_fetch_array($select)){

        if($rsConsulta['username'] == $login && $rsConsulta['senha'] == $senha){

            session_start();

            $_SESSION['status'] = "financeiro";

            header('location: ../painel-financeiro/painel-financeiro.php');

        }else
            header('location: ../autenticacao-financeiros.php?modo=invalid');
    }

}

?>