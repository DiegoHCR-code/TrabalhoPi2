<?php

if(!isset($_SESSION)){
    session_start();
    if($_SESSION['status']){
        session_destroy();
        header('location: ../home.php?logout');
    }else{
        header('location: ../home.php');
    }
        
}

?>