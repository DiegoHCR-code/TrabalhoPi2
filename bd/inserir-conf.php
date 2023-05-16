<?php

//tabelas
$porte = (String) "porte";
$doencas = (String) "doencas";
$especies = (String) "especies";
$cor_predominante = (String) "cor_predominante";
$temperamentos = (String) "temperamentos";
$raca = (String) "racas";
$fornecedores = (String) "fornecedores";
$categoria = (String) "categoria";


//cadastro de doenças
if(isset($_POST['txt-cadastro-doenca'])){
    require_once('functions.php');
    if(inserirConf($doencas, str_replace("'", " ", $_POST['txt-cadastro-doenca']))){
        header('location: ../config-animais.php');
    }
}
//cadastro de espécies
if(isset($_POST['txt-cadastro-especie'])){
    require_once('functions.php');
    if(inserirConf($especies, str_replace("'", " ", $_POST['txt-cadastro-especie']))){
        header('location: ../config-animais.php');
    }
}
//cadastro de temperamentos
if(isset($_POST['txt-cadastro-temperamento'])){
    require_once('functions.php');
    if(inserirConf($temperamentos, str_replace("'", " ", $_POST['txt-cadastro-temperamento']))){
        header('location: ../config-animais.php');
    }
}

//cadastro de porte físico
if(isset($_POST['txt-cadastro-porte'])){
    require_once('functions.php');
    if(inserirConf($porte, str_replace("'", " ", $_POST['txt-cadastro-porte']))){
        header('location: ../config-animais.php');
    }
}
//cadastro de cor predominante
if(isset($_POST['color-cadastro-cor'])){
    require_once('functions.php');
    if(inserirConf($cor_predominante, $_POST['color-cadastro-cor'])){
        header('location: ../config-animais.php');
    }
}

//cadastro de categoria
if(isset($_POST['btn-categoria'])){
    require_once('functions.php');
    if(inserirConf($categoria, str_replace("'", " ", $_POST['txt-cadastro-categoria']))){
        header('location: ../painel-produtos/cadastrar-categoria.php');
    }
}

//cadastro de raça
if(isset($_POST['btn-raca'])){
    require_once('functions.php');
    if(inserirRaca($raca, str_replace("'", " ", $_POST['txt-cadastro-raca']), $_POST['slt-especies'])){
        header('location: ../config-animais.php');
    }
}

//cadastro de fornecedor
if(isset($_POST['btn-fornecedor'])){
    require_once('functions.php');
    if(inserirFornecedor($fornecedores, str_replace("'", " ", $_POST['txt-nome-fornecedor']), $_POST['txt-cnpj-fornecedor'], $_POST['txt-telefone-fornecedor'])){
        header('location: ../painel-produtos/cadastrar-fornecedor.php');
    }
}

?>