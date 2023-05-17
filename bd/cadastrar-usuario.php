<?php
require_once('conexao.php');
$conexao = conexaoMysql();
session_start();
if(isset($_POST['btn-cadastrar-usuario'])){
    if(strtoupper($_POST['btn-cadastrar-usuario']) == "CADASTRAR"){
        $nome = $_POST['txt-nome-usuario'];
        $login = $_POST['txt-login'];
        $senha = $_POST['txt-senha'];
        $sql = "INSERT INTO usuarios (nome, username, senha)
        VALUES ('".$nome."','".$login."','".$senha."')";
        if(mysqli_query($conexao, $sql))
            header('location: ../criar-usuario.php');
        else
            echo('erro ao cadastrar usuario');
    }elseif(strtoupper($_POST['btn-cadastrar-usuario']) == "EDITAR"){
        $nome = $_POST['txt-nome-usuario'];
        $login = $_POST['txt-login'];
        $senha = $_POST['txt-senha'];
        $sql = "UPDATE usuarios SET nome = '".$nome."', username = '".$login."' , senha = '".$senha."' WHERE id = ".$_SESSION['id'];
        if(mysqli_query($conexao, $sql))
            header('location: ../criar-usuario.php');
        else
            echo('erro ao cadastrar usuario');
    }
}
?>