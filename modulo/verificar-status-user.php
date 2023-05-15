<?php

if(!isset($_SESSION)){

    session_start();

    if($_SESSION['status'] != "usuario"){
        header('location: autenticacao-usuarios.php?modo=nologged');
    }

}else{
    echo("AQUI");
}

?>