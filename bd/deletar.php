<?php

require_once('conexao.php');
$conexao = conexaoMysql();
$categoria = (String) "categoria";
$temperamento = (String) "temperamentos";
$porte = (String) "porte";
$doenca = (String) "doencas";
$cor_predominante = (String) "cor_predominante";
$raca = (String) "racas";
$especies = (String) "especies";
//$fornecedor = (String) "fornecedores";
$clientes = (String) "clientes";
//$produtos = (String) "produtos";
$animais = (String) "animais";
//$servicos = (String) "servicos";

//deletar categorias
if(isset($_GET['modo'])){
    require_once('functions.php');

    if($_GET['modo'] == 'deletarcategoria'){

        $id = $_GET['id'];

        if(deletarRegistro($categoria,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }
        
    }
    if($_GET['modo'] == 'deletarporte'){

        $id = $_GET['id'];

        if(deletarRegistro($porte,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }

    }
    if($_GET['modo'] == 'deletarcor'){

        $id = $_GET['id'];

        if(deletarRegistro($cor_predominante,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }
    }
    if($_GET['modo'] == 'deletartemperamento'){

        $id = $_GET['id'];

        if(deletarRegistro($temperamento,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }
    }
    if($_GET['modo'] == 'deletardoenca'){

        $id = $_GET['id'];

        if(deletarRegistro($doenca,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }
    }
    if($_GET['modo'] == 'deletarraca'){

        $id = $_GET['id'];

        if(deletarRegistro($raca,$id)){
            echo("<script> confirm('tem certeza que deseja excluir esse registro?') </script>");
            header('location: ../config-animais.php');
        }
    }
    if($_GET['modo'] == 'deletarespecie'){
        
        $id = $_GET['id'];

        if(deletarRegistro($especies,$id)){
            
            header('location: ../config-animais.php');
        }
    }
    /*if($_GET['modo'] == 'deletarfornecedor'){
        
        $id = $_GET['id'];

        if(deletarRegistro($fornecedor,$id)){
            header('location: ../config-animais.php');
        }
    }*/
    if($_GET['modo'] == 'deletarcliente'){

        $id = $_GET['id'];

        if(deletarRegistro($clientes, $id)){
            header('location: ../clientes.php');
        }
    }
    /*if($_GET['modo'] == 'deletarproduto'){
        $id = $_GET['id'];

        if(deletarRegistro($produtos, $id)){
            header('location: ../painel-produtos/visualizar-produtos.php');
        }
    }
    if($_GET['modo'] == 'deletarservico'){
        $id = $_GET['id'];

        if(deletarRegistro($servicos, $id)){
            header('location: ../painel-produtos/visualizar-servicos.php');
        }
    }*/
    if($_GET['modo'] == 'deletaranimal'){

        $id = $_GET['id'];
        $cliente = $_GET['idcliente'];

        $sql = "update ".$animais." set ativado = 0 where id = ".$id;
        
        if(mysqli_query($conexao, $sql)){
            if(isset($_GET['idcliente']))
                header('location: ../painel-cliente.php?idcliente='.$cliente);
            else
                header('location: ../animais.php');
        
        }else{
            echo("erro");
        }
    }
    if($_GET['modo'] == 'deletarusuario'){

        $id = $_GET['id'];

        $sql = "DELETE FROM usuarios WHERE id = ".$id;

        if(mysqli_query($conexao, $sql))
            header('location: ../criar-usuario.php');
        else
            echo("erro ao deletar usuario");
    }
}




?>