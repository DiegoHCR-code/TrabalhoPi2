<?php
if(!isset($_SESSION)){
    session_start();
    if($_SESSION['status'] != 'estoque'){
        header('location: ../autenticacao-estoque.php?modo=nologged&session=none');
    }
}
?>