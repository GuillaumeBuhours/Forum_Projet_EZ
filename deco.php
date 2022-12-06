<?php 
session_start(); 

function deconnect() {
    session_destroy();
    unset($_SESSION);
    header('url=accueil.php');
    exit();
}

deconnect();

?>