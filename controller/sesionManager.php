<?php

function sesionKiller(){
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Location: index.php");
    exit();
}

function verifySesion($flag){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
}    
    if ($flag) {
        if (isset($_SESSION['idPersona'])) {
            header("Location: menu.php");
            exit();
        }
    }else{
        if(session_status() == PHP_SESSION_NONE){
            session_start();
    }    
        if (!isset($_SESSION['idPersona'])) {
            header("Location: index.php");
            exit();
        }
    }
    
}
?>
