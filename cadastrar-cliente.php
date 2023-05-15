<?php

require_once('bd/conexao.php');
$conexao = conexaoMysql();
$botao = "CADASTRAR";
$checkM = "";
$checkF = "";
$checkO = "";

$nome = (String)"";
$cpf = (String)"";
$telefone = (String)"";
$celular = (String)"";
$data_nascimento = (String)"";
$email = (String)"";

$cep = (String)"";
$logradouro = (String)"";
$bairro = (String)"";
$cidade = (String)"";
$estado = (String)"";
$numero = (String)"";
$complemento = (String)"";



if(isset($_GET['modo'])){
    if(strtoupper($_GET['modo']) == "EDITAR"){

        session_start();

        $_SESSION['id'] = $_GET['idcliente'];

        $sql = "SELECT * FROM clientes WHERE id = ".$_GET['idcliente'];
        
        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){
            $nome = $rsConsulta['nome'];
            $cpf = $rsConsulta['cpf'];
            $telefone = $rsConsulta['telefone'];
            $celular = $rsConsulta['celular'];

            $data_nascimento = explode("-", $rsConsulta['data_nascimento']);
            $data_nascimento = $data_nascimento[2]."/".$data_nascimento[1];
            
            $email = $rsConsulta['email'];

            $sexo = $rsConsulta['sexo'];
            if(strtoupper($sexo) == "M")
                $checkM = "checked";
            elseif(strtoupper($sexo) == "F")
                $checkF = "checked";
            else
                $checkO = "checked";

            $cep = $rsConsulta['cep'];
            $logradouro = $rsConsulta['logradouro'];
            $bairro = $rsConsulta['bairro'];
            $cidade = $rsConsulta['cidade'];
            $estado = $rsConsulta['estado'];
            $numero = $rsConsulta['numero'];
            $complemento =$rsConsulta['complemento'];

            $botao = "EDITAR";
        }   
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petzone</title>
    <script src="js/modulo.js"></script>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <section class="cadastrar-cliente">
        <div class="wrapper-cadastrar">
        <div class="container container-atendimento">
        <form class="cadastro-cliente" action="bd/inserirCliente.php" method="post">
            <div class="cadastro-cliente-col">
                <h1>Cadastrar novo cliente
                    <h4 class="legenda">Itens marcados com ' <span class="obrigatorio">*</span> ' são obrigatórios</h4>
                </h1>

                <div class="text-input">
                    <h3>Nome <span class="obrigatorio">*</span></h3>
                    <input type="text" name="txt-cliente-nome" onkeypress="return validarEntrada(event,'numeric');" value="<?=$nome?>" class="input-cliente">
                </div>
                <div class="text-input">
                    <h3>Celular <span class="obrigatorio">*</span></h3>
                    <input type="text" placeholder="Ex (11) 999999999" name="txt-cliente-celular" onkeypress="return mascaraFone(this,event);" value="<?=$celular?>" id="telefone-cliente" class="input-cliente">
                </div>
                <div class="text-input">
                    <h3>Aniversario</h3>
                    <input type="text" onkeypress="return mascaraAniversario(this, event)" name="txt-cliente-nascimento" value="<?=$data_nascimento?>" class="input-cliente" id="aniversario">
                </div>
                <div class="text-input">
                    <h3>Instagram</h3>
                    <input type="text" placeholder="@exemplo" name="txt-cliente-email" value="<?=$email?>" class="input-cliente">
                </div>
                <h3>Sexo <span class="obrigatorio">*</span></h3>
                <div class="text-input-sexo">
                    Masculino<input value="M" type="radio" name="rdSexo" class="radio-option" <?=$checkM?>>
                    Feminino<input value="F" type="radio" name="rdSexo" class="radio-option" <?=$checkF?>>
                    Outros<input  Value="O" type="radio" name="rdSexo" class="radio-option" <?=$checkO?>>
                </div>

                <h2 class="endereco-titulo">Endereço <span class="obrigatorio">*</span></h2>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>CEP</p>
                    </div>
                    <div class="coluna-txt-input">
                        <input type="text" name="txt-cliente-cep" onkeypress="return mascaraCep(this,event);" value="<?=$cep?>" class="input-cliente-rua" id="cep">
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Logradouro</p>
                    </div>
                    <div class="coluna-txt-input">
                    <input type="text" name="txt-cliente-logradouro" value="<?=$logradouro?>" class="input-cliente-rua" id="logradouro">
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Numero</p>
                    </div>
                    <div class="coluna-txt-input">
                    <input type="text" name="txt-cliente-numero" onkeypress="return validarEntrada(event,'string');" value="<?=$numero?>" class="input-cliente-rua">    
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Complemento</p>
                    </div>
                    <div class="coluna-txt-input">
                    <input type="text" name="txt-cliente-complemento" value="<?=$complemento?>" class="input-cliente-rua" id="complemento" placeholder="Ex. Apto 123 - bloco 2">
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Bairro</p>
                    </div>
                    <div class="coluna-txt-input">
                        <input type="text" name="txt-cliente-bairro" value="<?=$bairro?>" class="input-cliente-rua" id="bairro">
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Cidade</p>
                    </div>
                    <div class="coluna-txt-input">
                    <input type="text" name="txt-cliente-cidade" value="<?=$cidade?>" class="input-cliente-rua" id="cidade">
                    </div>
                </div>
                <div class="text-input-row">
                    <div class="coluna-txt-input">
                        <p>Estado</p>
                    </div>
                    <div class="coluna-txt-input">
                        <input type="text" name="txt-cliente-estado" value="<?=$estado?>" class="input-cliente-estado" id="estado">
                    </div>
                </div>

                <div class="text-input">
                    <input type="submit" name="btn-cadastrar-cliente" class="botao botao-cadastrar" value="<?=$botao?>">
                </div>
            </div>
        </form>
    </div>
        </div>
   </section>
    <script src="js/cep.js"></script>
</body>
</html>