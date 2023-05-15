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
                <img src="icon/monitoramento.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        <a href="agendamento-transporte.php" class="texto-branco">
            AGENDAR TAXI DOG
            <div class=" icones-holder">
                <img src="icon/taxi.png" alt="img" class="iconesMenu">
            </div>
        </a>

    </div>
    <div class="menu-item texto-branco">
        <a href="monitoramento.php" class="texto-branco">
            MONITORAR SERVIÇOS
            <div class=" icones-holder">
                <img src="icon/pet.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        <a href="clientes.php" class="texto-branco">
            CLIENTES CADASTRADOS
            <div class=" icones-holder">
                <img src="icon/avatar/man3.png" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        
        <a href="home.php" class="texto-branco">
            ANIVESÁRIANTES
            <div class=" icones-holder">
                <img src="#" alt="gift" class="iconesMenu">
            </div>
        </a>
    
    </div>
    <div class="menu-item texto-branco">
        <a href="animais.php" class="texto-branco">
            ANIMAIS CADASTRADOS
            <div class=" icones-holder">
                <img src="#" alt="img" class="iconesMenu">
            </div>
        </a>
    </div>
    <div class="menu-item texto-branco">
        <a href="config-animais.php" class="texto-branco">
            CONFIGURAÇÕES
            <div class=" icones-holder">
                <img src="#" alt="img" class="iconesMenu">
            </div>
        </a>
    
    </div>
    <div class="menu-item texto-branco">
        
        <a href="autenticacao-estoque.php" class="texto-branco">
            ESTOQUE 
            <img src="icon/<?=$imgEstoque?>" alt="locked">

            <div class=" icones-holder">
                <img src="icon/box.png" alt="img" class="iconesMenu">
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

    <div class="menu-item texto-branco">
        <a href="autenticacao-financeiro.php" class="texto-branco">
            FINANCEIRO
            <img src="icon/lock.png" alt="locked">

            <div class=" icones-holder">
                <img src="icon/money.png" alt="img" class="iconesMenu">
            </div>
        </a>
    
    </div>
</div>


