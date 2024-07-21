<?php

function sesionKiller(){
    session_start();
    session_unset(); 
    session_destroy(); 
    header("Location: index.php");
    exit();
}

function verifySesion($flag){
    if ($flag) {
        session_start();
        if (isset($_SESSION['idPersona'])) {
            header("Location: menu.php");
            exit();
        }
    }else{
        session_start();
        if (!isset($_SESSION['idPersona'])) {
            header("Location: index.php");
            exit();
        }
    }
    
}
?>
