<?php require_once("bd/conexao.php");
    $conexao = conexaoMysql();

    $sql="select * from racas where id_especie = '".$_POST['id']."'";
    $select = mysqli_query($conexao, $sql);

    while($rsRaca = mysqli_fetch_array($select)){
        echo("<option value=".$rsRaca['id'].">".$rsRaca['nome']."</option>");
    }
