<?php
include_once "../forum/index.php";


$pdo = pdo_connect();

    if(isset($_POST['submit']) 
    && !empty($_POST['mail']) 
    && !empty($_POST['pseudo']) 
    && !empty($_POST['mdp'])){
        $_REQUEST = $pdo->prepare("INSERT INTO utilisateurs VALUE(NULL, :mail, :pseudo, :mdp)");
        $_REQUEST->execute([
            'mail' => $_POST['mail'],
            'pseudo' => $_POST['pseudo'],
            'mdp' => $_POST['mdp']
        ]);
        header("refresh:5; url=../accueil.php");
    }