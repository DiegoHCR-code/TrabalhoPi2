<?php

    function conexaoMysql(){
        
        $server = (string) "localhost"; //local de instalação do banco de dados

        $user = (string) "root"; //usuario para conexão com o banco de dados

        $password = (string) "bcd127"; //senha para conexão com o banco de dados

        $database = (string) "trabalhopi2diegohenrique"; //nome do database

        $conexao = mysqli_connect($server, $user, $password, $database);
        
        return $conexao;
    }
    
?>