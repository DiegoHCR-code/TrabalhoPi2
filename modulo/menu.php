<?php

$imgEstoque = (String)"lock.png";
$imgUsuario = (String)"lock.png";
$imgFinanceiro = (String)"lock.png";

if(!isset($_SESSION)){
    
    session_start();

    if(isset($_SESSION['status'])){

        if($_SESSION['status'] == "estoque"){

            $imgEstoque = "unlock.png";

        }elseif($_SESSION['status'] == "usuario"){

            $imgUsuario = "unlock.png";

        }elseif($_SESSION['status'] == "financeiro"){

            $imgFinanceiro = "unlock.png";

        }

        
        
    }
}
?>
<div class="menu-painel ">
    <div id="abrir-menu">
        <img src="painel-produtos/img/menu.png" alt="menu" id="menu">
    </div>
    <div class="menu-item texto-branco">
        <a href="atendimento.php" class="texto-branco">
            ATENDIMENTO

            <div class=" icones-holder">
                <img src="./icon/monitoramento.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        <a href="clientes.php" class="texto-branco">
            CLIENTES CADASTRADOS
            <div class=" icones-holder">
                <img src="./icon/avatar/man3.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        
        <a href="home.php" class="texto-branco">
            ANIVESÁRIANTES
            <div class=" icones-holder">
                <img src="./icon/gift.png" alt="gift" class="iconesMenu">
            </div>
        </a>
    
    </div>
    <div class="menu-item texto-branco">
        <a href="animais.php" class="texto-branco">
            ANIMAIS CADASTRADOS
            <div class=" icones-holder">
                <img src="./icon/dog.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        <a href="config-animais.php" class="texto-branco">
            CONFIGURAÇÕES
            <div class=" icones-holder">
                <img src="./icon/pawprint.png" alt="img" class="iconesMenu">
            </div>
        </a>
    
    </div>

    <div class="menu-item">
        <a href="autenticacao-estoque.php">
            Serviços Armazenados
            <img src="icon/<?=$imgEstoque?>" alt="locked">

            <div class="icones-holder">
                <img src="icon/box.png" alt="iconesMenu">
            </div>

        </a>
    </div>

    <div class="menu-item texto-branco">

        <a href="autenticacao-usuarios.php" class="texto-branco">
            CRIAR USUARIOS
            <img src="icon/<?=$imgUsuario?>" alt="locked">

            <div class=" icones-holder">
                <img src="icon/avatar/user1.png" alt="img" class="iconesMenu">
            </div>
        </a>
    
    </div>
</div>


