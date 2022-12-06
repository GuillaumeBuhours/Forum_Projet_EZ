<?php 
session_start(); 

function deconnect() {
    session_destroy();
    unset($_SESSION);
    header('location:accueil.php');
    exit();
}

deconnect();

?>