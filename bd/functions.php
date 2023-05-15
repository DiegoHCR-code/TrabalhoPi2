<?php
//função para adicionar itens nas tabelas de configuração de animais
function inserirConf ( $tabela, $nome ){

    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "insert into ".$tabela." (nome) values ('".$nome."')";
    
    if($insere = mysqli_query($conexao, $sql)){
        
        return $insere;
    }else{
        echo("erro ao executar o script");
        echo($sql);
    }
}
//função para cadastrar Raças
function inserirRaca ( $tabela, $nome, $especie ){

    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "insert into ".$tabela." (nome, id_especie) values ('".$nome."' , ".$especie.")";
    
    if($insere = mysqli_query($conexao, $sql)){
        return $insere;
    }else{
        echo("erro ao executar o script");
        echo($sql);
    }
}
//Função para cadastrar Fornecedors
function inserirFornecedor ( $tabela, $nome, $cnpj, $tel ){

    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "insert into ".$tabela." (nome, cnpj, telefone) values ('".$nome."' , '".$cnpj."','".$tel."')";
    
    if($insere = mysqli_query($conexao, $sql)){
        return $insere;
    }else{
        echo("erro ao executar o script");
        echo($sql);
    }
}
//Função para cadastrar Clientes
function inserirCliente( $nome, $cpf, $telefone, $celular, $data_nascimento, $email, $sexo, $cep, $logradouro, $bairro, $cidade, $estado, $numero, $complemento, $avatar ){
    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "insert into clientes 
            (nome, cpf, telefone, celular, data_nascimento, email, sexo, cep, logradouro, bairro, cidade, estado, numero, complemento, avatar)
            values
            ('".$nome."' , '".$cpf."','".$telefone."','".$celular."','".$data_nascimento."', '".$email."','".$sexo."','".$cep."',
            '".$logradouro."','".$bairro."','".$cidade."','".$estado."','".$numero."', '".$complemento."', '".$avatar."')";
    
    if($insere = mysqli_query($conexao, $sql)){
        return $insere;
    }else{
        echo("erro ao executar o script");
        echo($sql);
    }
}
//Função para deletar registros
function deletarRegistro($tabela,$id){
    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "update ".$tabela." set ativado = 0 where id = ".$id;

    if($deleta = mysqli_query($conexao, $sql)){
        return $deleta;
    }else{
        header('location: ../error-delete.php');
    }
}
function deletarAnimal($tabela, $id){

    require_once('conexao.php');
    $conexao = conexaoMysql();

    $sql = "delete from ".$tabela." where id = ".$id;

    if(mysqli_query($conexao, $sql)){
        
        $sqlanimal_doenca = "delete from animal_doenca where id_animal = ".$id;
        echo($sqlanimal_doenca);
            
            if($delete = mysqli_query($conexao, $sqlanimal_doenca)){
                echo($sqlanimal_doenca);
                return $delete;
            }else{

                echo("erro");
            }
    }
}


?>