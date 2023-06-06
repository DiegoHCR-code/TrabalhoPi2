<?php

require_once('bd/conexao.php');
$conexao = conexaoMysql();

if(isset($_POST['modo'])){
    if(strtoupper($_POST['modo']) == 'VISUALIZAR'){

        $idOs = $_POST['id'];

        $sql = "SELECT ordem_servico.*, animais.nome AS animal, especies.nome AS especie FROM ordem_servico INNER JOIN animais 
        ON ordem_servico.id_animal = animais.id INNER JOIN especies ON animais.id_especie = especies.id WHERE ordem_servico.id = ".$idOs;

        $select = mysqli_query($conexao, $sql);

        if($rsConsulta = mysqli_fetch_array($select)){

            $nome_cliente = $rsConsulta['nome_cliente'];
            $animal = $rsConsulta['animal'];
            $especie = $rsConsulta['especie'];
            $contato_cliente = $rsConsulta['contato_cliente'];
            $horario_ordem = $rsConsulta['horario_ordem'];
            $obs = $rsConsulta['obs'];
            $transporte = $rsConsulta['transporte'];
            $situacao = $rsConsulta['situacao'];
            $situacao_pagamento = $rsConsulta['situacao_pagamento'];
            $total = $rsConsulta['total'];
            $valor_transporte = $rsConsulta['valor_transporte'];

            if($transporte != 0){
                $numero = $rsConsulta['numero'];
                $logradouro = $rsConsulta['logradouro'];
                $cep = $rsConsulta['cep'];
                $bairro = $rsConsulta['bairro'];
                $cidade = $rsConsulta['cidade'];
                $uf = $rsConsulta['uf'];
            }
            
        }

    }

}

?>

<div class="header-modal-os menu-opns">
    INFORMAÇÕES DO CLIENTE
</div>
<div class="linha-modal-os">
    Nome: <?=$nome_cliente?> - Tel: <?=$contato_cliente?>
</div>
<div class="linha-modal-os">
    Animal: <?=$animal?> (<?=$especie?>)
</div>


<div class="header-modal-os menu-opns">
    SERVIÇOS
</div>

<?php

$sqlServicos = "SELECT ordem_servico_servico.*, servicos.* FROM ordem_servico_servico INNER JOIN servicos 
ON ordem_servico_servico.id_servico = servicos.id WHERE ordem_servico_servico.id_ordem_servico = ".$_POST['id'];

$selectServicos = mysqli_query($conexao, $sqlServicos);

while($rsServicos = mysqli_fetch_array($selectServicos)){

?>
<div class="linha-modal-os">
    <div class="coluna-modal-os">
        <?=$rsServicos['nome']?>
    </div>
    <div class="coluna-modal-os">
        R$ <?=number_format($rsServicos['preco'], 2, ',','.')?>
    </div>
</div>
<?php
}

if($situacao_pagamento != 1){

?>
<div class="linha-modal-os">
    <div class="coluna-modal-os">
        TOTAL A PAGAR
    </div>
    <div class="coluna-modal-os">
        R$ <?=number_format($valor_transporte+$total, 2, ',','.')?>
    </div>
</div>

<?php
}
?>
</form>

<?php

    if($situacao_pagamento != 0){

?>
<div class="header-modal-os azul-marinho">
    CONCLUIR ORDEM DE SERVIÇO
</div>
<form method="POST" action="bd/atualizar-status.php?idos=<?=$idOs?>" class="linha-modal-os-botao">

    <button type="submit" name="btn-concluir" class="botao">
        CONCLUIR <img src="icon/verificado.png" alt="botao">
    </button>
    <button type="submit" name="btn-fechar" class="botao">
        CANCELAR <img src="icon/cancelado.png" alt="botao">
    </button>

</form>
<?php

    }

?>







