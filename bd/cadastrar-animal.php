<?php

require_once('conexao.php');
$conexao = conexaoMysql();

$nomeDono = (String)"";
$contatoDono = (String)"";

if(isset($_POST['btn-cadastrar-animal'])){

    $nome = str_replace("'", " ", $_POST['txt-animal-nome']);
    $idade = $_POST['txt-animal-idade'];
    $porte = $_POST['slt-porte-animal'];
    $temperamento = $_POST['slt-temperamento-animal'];
    $cor_predominante = $_POST['txt-cor'];
    $especie = $_POST['slt-especie-animal'];
    $raca = $_POST['slt-raca-animal'];
    
    
    if(isset($_GET['idtransporte']) || isset($_GET['idcliente'])){

        if(isset($_GET['idcliente'])){

            $dono = $_GET['idcliente'];

            $sql = "insert into animais (nome,
            idade,id_porte,id_temperamento,id_cor,id_especie,id_raca,id_dono) values
            ('".$nome."',".$idade.",".$porte.",".$temperamento.",".$cor_predominante.",
            ".$especie.",".$raca.",".$dono.")";

        }else{

            $nomeDono = str_replace("'", " ", $_POST['txt-animal-nome-dono']);
            $contatoDono = $_POST['txt-animal-contato-dono'];

            $sql = "insert into animais (nome,
            idade,id_porte,id_temperamento,id_cor,id_especie,id_raca,nome_dono,contato_dono) values
            ('".$nome."',".$idade.",".$porte.",".$temperamento.",".$cor_predominante.",
            ".$especie.",".$raca.",'".$nomeDono."','".$contatoDono."')";
            
        }
            

        if(mysqli_query($conexao, $sql)){

            if(!empty($_POST['checklist'])){

                $sql = "select id from animais order by id desc limit 1";

                $select = mysqli_query($conexao, $sql);

                if($rsConsulta = mysqli_fetch_array($select)){

                    foreach($_POST['checklist'] as $selected){

                        $sqlDoencas = "insert into animal_doenca (id_animal, id_doenca) values (".$rsConsulta['id'].", ".$selected.")";

                        if(mysqli_query($conexao, $sqlDoencas)){
                            echo("foi");

                            // if(strtoupper($modo) == 'TRANSPORTE'){
                            //     header('location: ../transporte-animais.php?idcliente='.$dono);
                            // }else{
                            //     echo($modo);
                            //     header('location: ../painel-cliente.php?idcliente='.$dono);
                            // }

                        }else{
                            echo("erro");
                        }
                    }
                    if(isset($_GET['idtransporte'])){

                        $idTransporte = $_GET['idtransporte'];

                        $sqlTransporte = "insert into transporte_animal (id_transporte, id_animal) values (".$idTransporte.", ".$rsConsulta['id'].")";

                        if(mysqli_query($conexao, $sqlTransporte)){
                            header('location: ../transporte-animais.php?idtransporte='.$idTransporte);
                        }else{
                            echo($sql);
                        }

                    }else{
                        if(!isset($_GET['modo']))
                            header('location: ../painel-cliente.php?idcliente='.$dono);
                        else
                            header('location: ../painel-cliente.php?idcliente='.$dono.'&modo=close');
                    }

                }else{
                    echo($sql);
                    echo("DEU MERDA AQUI");
                }
  
            }else{

                if(isset($_GET['idtransporte'])){

                    $sql = "select id from animais order by id desc limit 1";

                    $select = mysqli_query($conexao, $sql);

                    if($rsConsulta = mysqli_fetch_array($select)){

                        $idTransporte = $_GET['idtransporte'];

                        $sqlTransporte = "insert into transporte_animal (id_transporte, id_animal) values (".$idTransporte.", ".$rsConsulta['id'].")";

                        if(mysqli_query($conexao, $sqlTransporte)){
                            header('location: ../transporte-animais.php?idtransporte='.$idTransporte);
                        }else{
                            echo($sql);
                        }

                    }

                }else{
                    if(!isset($_GET['modo']))
                        header('location: ../painel-cliente.php?idcliente='.$dono);
                    else
                        header('location: ../painel-cliente.php?idcliente='.$dono.'&modo=close');
                }
                // if(strtoupper($modo) == 'TRANSPORTE'){

                //     header('location: ../transporte-animais.php?idcliente='.$dono);

                // }else{
                    
                //     header('location: ../painel-cliente.php?idcliente='.$dono);

                // }
            }
            
        }else{
            echo("nao entrou122");
            echo($sql);
        }
    }else{

        $nomeDono = str_replace("'", " ", $_POST['txt-animal-nome-dono']);
        
        $contatoDono = $_POST['txt-animal-contato-dono'];

        $sql = "insert into animais (nome,
        idade,id_porte,id_temperamento,id_cor,id_especie,id_raca,nome_dono, contato_dono) values
        ('".$nome."',".$idade.",".$porte.",".$temperamento.",".$cor_predominante.",
        ".$especie.",".$raca.",'".$nomeDono."', '".$contatoDono."')";

        if(mysqli_query($conexao, $sql)){

            $sql = "select id from animais order by id desc limit 1";

            $select = mysqli_query($conexao, $sql);

            $rsConsulta = mysqli_fetch_array($select);
            

            if(!empty($_POST['checklist'])){

                foreach($_POST['checklist'] as $selected){

                    $sqlDoencas = "insert into animal_doenca (id_animal, id_doenca) values (".$rsConsulta['id'].", ".$selected.")";

                    if(mysqli_query($conexao, $sqlDoencas)){
                        echo("Redirecionando...");                    
                    }else{
                        echo("erro");
                    }

                }

                if(isset($_GET['idos']))
                    $sql = "update ordem_servico set id_animal = ".$rsConsulta['id']." where id = ".$_GET['idos'];
                else
                    $sql = "insert into transporte_animal (id_transporte, id_animal) values (".$idTransporte.", ".$rsConsulta['id'].")";
                

                if(mysqli_query($conexao, $sql)){

                    if(isset($_GET['idos']))
                        header('location: ../consumir-servicos.php?idos='.$_GET['idos']);
                    else
                        header('location: ../transporte-animais.php?idtransporte='.$idTransporte);

                }else{
                    echo($sql);
                }
                
            }else{

                if(isset($_GET['idos']))
                    $sql = "update ordem_servico set id_animal = ".$rsConsulta['id']." where id = ".$_GET['idos'];
                else
                    $sql = "insert into transporte_animal (id_transporte, id_animal) values (".$idTransporte.", ".$rsConsulta['id'].")";
                

                if(mysqli_query($conexao, $sql)){

                    if(isset($_GET['idos']))
                        header('location: ../consumir-servicos.php?idos='.$_GET['idos']);
                    else
                        header('location: ../transporte-animais.php?idtransporte='.$idTransporte);

                }else{
                    echo($sql);
                }
            }
            
        }else{
            echo("nao entrou");
            echo($sql);
        }
    }
}


?>
