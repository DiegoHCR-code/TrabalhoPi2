<?php

    require_once('conexao.php');
    $conexao = conexaoMysql();
    date_default_timezone_set('America/Sao_Paulo');

    if(isset($_POST['btn-cadastrar-ordem'])){

        //primeira query
        $sql = "SELECT * FROM ordem_servico ORDER BY id DESC LIMIT 1";

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            
            $animal = $_POST['slt-animal'];

            $nome = $_POST['txt-nome-ordem'];
            $contato = $_POST['txt-contato-ordem'];
            $data_ordem = date('Y-m-d');
            $horario_ordem = date('H:i:s');
            $obs = $_POST['txt-obs-ordem'];
            $transporte = $_POST['rdoTaxiDog'];
            $situacao = 'A';

            //endereco
            $cep = $_POST['txt-cep-ordem'];
            $logradouro = $_POST['txt-logradouro-ordem'];
            $numero = $_POST['txt-numero-ordem'];
            $bairro = $_POST['txt-bairro-ordem'];
            $cidade = $_POST['txt-cidade-ordem'];
            $uf = $_POST['txt-uf-ordem'];

           

            if(isset($valor_transporte)){
                $valor_transporte = explode(",", $_POST['txt-valor-transporte']);
                $valor_transporte = $valor_transporte[0].".".$valor_transporte[1];
            }else{
                $valor_transporte = explode(",", $_POST['txt-valor-transporte']);
                $valor_transporte = $valor_transporte[0].".".$valor_transporte[1];
            }
            
            // REALIZAR UPDATE
            if($transporte == 1){

                if(isset($_GET['idcliente'])){

                    $sqlOs = "update ordem_servico set id_animal =".$animal." ,
                    nome_cliente = '".$nome."' , contato_cliente = '".$contato."' , data_ordem = '".$data_ordem."' ,
                    horario_ordem = '".$horario_ordem."' , obs = '".$obs."' , transporte = ".$transporte." , 
                    situacao = '".$situacao."', cep = '".$cep."', logradouro = '".$logradouro."',
                    numero = '".$numero."', bairro = '".$bairro."', cidade = '".$cidade."',
                    uf = '".$uf."', valor_transporte = '".$valor_transporte."' where id = ".$rsConsulta['id'];

                }else{

                    $sqlOs = "update ordem_servico set 
                    nome_cliente = '".$nome."' , contato_cliente = '".$contato."' , data_ordem = '".$data_ordem."' ,
                    horario_ordem = '".$horario_ordem."' , obs = '".$obs."' , transporte = ".$transporte." , 
                    situacao = '".$situacao."', cep = '".$cep."', logradouro = '".$logradouro."',
                    numero = '".$numero."', bairro = '".$bairro."', cidade = '".$cidade."',
                    uf = '".$uf."', valor_transporte = '".$valor_transporte."' where id = ".$rsConsulta['id'];

                }

                

            }else{

                if(isset($_GET['idcliente'])){
                    //segunda query

                    $sqlOs = "update ordem_servico set id_animal =".$animal." ,
                    nome_cliente = '".$nome."' , contato_cliente = '".$contato."' , data_ordem = '".$data_ordem."' ,
                    horario_ordem = '".$horario_ordem."' , obs = '".$obs."' , transporte = '".$transporte."' , 
                    situacao = '".$situacao."' where id = ".$rsConsulta['id'];

                }else{

                    $sqlOs = "update ordem_servico set 
                    nome_cliente = '".$nome."' , contato_cliente = '".$contato."' , data_ordem = '".$data_ordem."' ,
                    horario_ordem = '".$horario_ordem."' , obs = '".$obs."' , transporte = '".$transporte."' , 
                    situacao = '".$situacao."' where id = ".$rsConsulta['id'];

                }
                
            }

            if(mysqli_query($conexao, $sqlOs)){

                //terceira query
                $sqlServicoOrdem = "SELECT * FROM ordem_servico_servico WHERE id_ordem_servico = ".$rsConsulta['id'];

                $selectServicoOrdem = mysqli_query($conexao, $sqlServicoOrdem);
                
                $rsServicoOrdem = mysqli_fetch_array($selectServicoOrdem);

                if($rsServicoOrdem['id_ordem_servico'] != ""){

                    //quarta query
                    $deleteSql = "DELETE FROM ordem_servico_servico WHERE id_ordem_servico = ".$rsConsulta['id'];

                    if(mysqli_query($conexao, $deleteSql)){

                        if(!empty($_POST['checklist'])){

                            foreach($_POST['checklist'] AS $selected){
            
                                $sql = "INSERT INTO ordem_servico_servico (id_ordem_servico, id_servico)
                                VALUES (".$rsConsulta['id'].", ".$selected.")";

                                if(mysqli_query($conexao, $sql)){

                                    if(isset($_GET['idcliente'])){
                                        header('location: ../confirmar-ordem-servico.php?ido3131s='.$rsConsulta['id'].'&idcliente='.$_GET['idcliente']);
                                    }else{
                                        header('location: ../confirmar-ordem-servico.php?i3131dos='.$rsConsulta['id']);
                                    }

                                }else{

                                    echo("erro ao executar esse scritp");

                                } 
                            }
                        }
                    }else{
                        echo("Erro na quarta QUERY");
                        echo($deleteSql);
                    }
                }else{
                    echo("<h1> SELECIONE AO MENOS UM SERVIÇO</h1>");

                    if(!empty($_POST['checklist'])){

                        foreach($_POST['checklist'] AS $selected){
        
                            $sql = "INSERT INTO ordem_servico_servico (id_ordem_servico, id_servico)
                            VALUES (".$rsConsulta['id'].", ".$selected.")";

                            if(mysqli_query($conexao, $sql)){

                                if(isset($_GET['idcliente'])){
                                    header('location: ../confirmar-ordem-servico.php?idos='.$rsConsulta['id'].'&idcliente='.$_GET['idcliente']);
                                }else{
                                    header('location: ../confirmar-ordem-servico.php?idos='.$rsConsulta['id']);
                                }

                            }else{

                                echo("Erro na terceira Query");

                            } 
                        }
                        echo("erro aqui");
                    }
                }
            }else{
                echo("Erro na segunda QEURY");
                echo($sqlOs);
            }
        }else{
            echo('Erro na primeira QUERY');
        }
    }

?>