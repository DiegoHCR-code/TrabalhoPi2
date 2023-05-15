<?php
require_once('conexao.php');
$conexao = conexaoMysql();

if(isset($_POST['btn-autenticar'])){
    $celular = $_POST['txtcelular'];

    $sql = "SELECT * FROM clientes WHERE celular = '".$celular."'";

    $select = mysqli_query($conexao, $sql);

    $rsConsulta = mysqli_fetch_array($select);

    if(empty($celular) || $celular != $rsConsulta['celular']){
        header('location: ../error-cpf.php');
    }else{
        if($celular == $rsConsulta['celular']){

            session_start();
    
            $_SESSION['id'] = $rsConsulta['id'];
    
            $_SESSION['nome'] = $rsConsulta['nome'];
            $_SESSION['celular'] = $rsConsulta['celular'];
            $_SESSION['email'] = $rsConsulta['email'];
    
            $_SESSION['cep'] = $rsConsulta['cep'];
            $_SESSION['logradouro'] = $rsConsulta['logradouro'];
            $_SESSION['bairro'] = $rsConsulta['bairro'];
            $_SESSION['cidade'] = $rsConsulta['cidade'];
            $_SESSION['estado'] = $rsConsulta['estado'];
            $_SESSION['numero'] = $rsConsulta['numero'];
    
            $_SESSION['avatar'] = $rsConsulta['avatar'];
    
            
            
    
            header('location: ../painel-cliente.php?idcliente='.$_SESSION['id']);
        }
    }

    
}

?>