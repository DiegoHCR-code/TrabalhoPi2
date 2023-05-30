<?php

    require_once('bd/conexao.php');
    $conexao = conexaoMysql();

    $nome = (String)"";
    $contato = (String)"";
    $animal = (String)"";
    $link = (String)"";
    $action = (String)"";

    $cep = (String)"";
    $logradouro = (String)"";
    $numero = (String)"";
    $bairro = (String)"";
    $cidade = (String)"";
    $uf = (string)"";

    $adicionar = (String) "Adicionar animal";


    if(isset($_GET['idcliente'])){

        $link = (String)"cadastro-animal.php?idcliente=".$_GET['idcliente'];
        $action = "bd/cadastrar-ordem-servico.php?idcliente=".$_GET['idcliente'];
        
        $sql = "SELECT * FROM clientes WHERE id = ".$_GET['idcliente'];

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            $nome = $rsConsulta['nome'];
            $contato = $rsConsulta['celular'];

            //endereco cliente
            $cep = $rsConsulta['cep'];
            $logradouro = $rsConsulta['logradouro'];
            $bairro = $rsConsulta['bairro'];
            $cidade = $rsConsulta['cidade'];
            $estado = $rsConsulta['estado'];
            $numero = $rsConsulta['numero'];
        }
    }else{

        $sql = "SELECT * FROM ordem_servico ORDER BY id DESC LIMIT 1";

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            $idos = $rsConsulta['id'];

            $sql = "select ordem_servico.*, animais.* from ordem_servico inner join animais on 
            ordem_servico.id_animal = animais.id where ordem_servico.id = ".$idos;

            $selectOrdemAnimal = mysqli_query($conexao, $sql);

            if($rsConsultaAnimal = mysqli_fetch_array($selectOrdemAnimal)){

                if($rsConsultaAnimal['id_animal'] != ""){
                    $adicionar = "Mudar";
                }

                $nome = $rsConsultaAnimal['nome_dono'];
                $contato = $rsConsultaAnimal['contato_dono'];

            }
        }
            

        $link = (String)"cadastro-animal.php?idos=".$idos;
        $action = "bd/cadastrar-ordem-servico.php";

    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SIAP</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="painel-produtos/js/toggle-menu.js"></script>
        <script src="js/modulo.js"></script>
        <script>
            $(document).ready(function(){
                
                $('#transporteSim').click(function(){
                    $('#endereco-os').css({
                        display:'block',
                        
                    });
                    $('.ativar').attr('required', 'required');
                });
                $('#transporteNao').click(function(){
                    $('#endereco-os').css({
                        display:'none',
                       
                    });
                    $('.ativar').removeAttr('required');
                });
                var count = 0;
                $('#confirmButton').click(function (){
                    count ++;
                    if(count > 1){
                        $(this).css('pointer-events', 'none');
                        $(this).css({'cursor':'no-drop'});
                        return false;
                    }
                })
            });
        </script>
    </head>
    <body class="body-consumir-servicos">

        <div class="pagina-inicial-transporte">
            <div class="formulario-agendamento-servico">
                <form action="<?=$action?>" method="POST" class="cadastrar-ordem-servico" id="formOS">
                    <div class="linha-tabela-orderm">
                        <div class="coluna-tabela-ordem-nome">
                            <h5>Animal</h5>
                        </div>
                        <div class="coluna-tabela-ordem">
                                <?php
                                    if(isset($_GET['idcliente'])){
                                ?>
                            <select name="slt-animal" id="select-ordem-animal" required>
                                <option value="">Selecione o animal</option>

                                
                                <?php        
                                        $sqlAnimais = " SELECT animais.* FROM animais WHERE animais.ativado = 1 AND animais.id_dono = ".$_GET['idcliente'];

                                        $selectAnimais = mysqli_query($conexao, $sqlAnimais);

                                        while($rsAnimais = mysqli_fetch_array($selectAnimais))
                                        {
                                ?>
                                <option value="<?=$rsAnimais['id']?>"><?=$rsAnimais['nome']?></option>
                                <?php

                                        }
                                    }elseif(isset($_GET['idos'])){
                                        $sqlAnimais = "SELECT ordem_servico.*, animais.nome FROM ordem_servico
                                            INNER JOIN animais ON ordem_servico.id_animal = animais.id WHERE ordem_servico.id =".$_GET['idos'];
                                        
                                        $selectAnimais = mysqli_query($conexao, $sqlAnimais);

                                        if($rsAnimais = mysqli_fetch_array($selectAnimais)){
                                            $animal = $rsAnimais['nome'];
                                        }
                                ?>
                                <input type="text" value="<?=$animal?>" readonly id="">
                                <?php
                                    }else{
                                ?>
                                    <select name="" id="" required >
                                        <option value="" required >Escolha um animal</option>
                                    </select>
                                <?php
                                    }
                                ?>





                            </select>
                            <a href="<?=$link?>"><?=$adicionar?></a>
                        </div>
                    </div>



                    <div class="linha-tabela-orderm margem-bottom-pequena">
                        <div class="coluna-tabela-ordem-nome">
                            <h5>Nome do cliente</h5>
                        </div>
                        <div class="coluna-tabela-ordem">
                            <input type="text" name="txt-nome-ordem" onkeypress="return validarEntrada(event,'numeric');" value="<?=$nome?>" class='input-ordem'>
                        </div>
                    </div>

                    <div class="linha-tabela-orderm">
                        <div class="coluna-tabela-ordem-nome">
                            <h5>Telefone para contato</h5>
                        </div>
                        <div class="coluna-tabela-ordem">
                            <input type="text" name="txt-contato-ordem" onkeypress="return mascaraFone(this,event);" value="<?=$contato?>" class="input-ordem">
                        </div>
                    </div>

                    
                    
                    
                    <div class="titulo-servicos">
                        <h5>Selecione os serviços</h5>
                    </div>
                    <hr>

                    <!-- servicos vindos do banco de dados -->
                    <div class="tabela-servicos-ordem">

                    <?php
                    
                        $sqlServicos = "SELECT * FROM servicos WHERE ativado = 1";

                        $selectServicos = mysqli_query($conexao, $sqlServicos);

                        while($rsServicos = mysqli_fetch_array($selectServicos))
                        {

                    ?>



                        <div class="linha-tabela-servicos">
                            <div class="coluna-ordem-servico">
                                <input type="checkbox" name="checklist[]" value="<?=$rsServicos['id']?>" class="checkbox-ordem">
                            </div>
                            <div class="coluna-tabela-servicos">
                                <?=$rsServicos['nome']?>
                            </div>
                            <div class="coluna-tabela-servico-preco">
                                R$ <?=number_format($rsServicos['preco'], 2, ',', '.')?>
                            </div>
                        </div>
                    <?php

                        }

                    ?>
                        <!-- *************************** -->
                    </div>
                    <hr>
                    <div class="linha-tabela-orderm margem-top-pequena margem-bottom-pequena">
                        <div class="coluna-tabela-ordem-nome">
                            <h5>Observações</h5>
                        </div>
                        <div class="coluna-tabela-ordem">
                            <textarea name="txt-obs-ordem" id="descricao-obs"></textarea>
                        </div>
                    </div>



                    <div class="linha-tabela-servicos">
                        <button id="confirmButton" type="submit" name="btn-cadastrar-ordem" class="botao center">
                            
                            CONFIRMAR
                            <div class='buttonActionCancel'> 
                            
                            </div>
                        </button>
                    </div>  
                </form>
            

            </div>
        </div>
    </body>
</html>