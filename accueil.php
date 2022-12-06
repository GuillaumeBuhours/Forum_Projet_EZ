<?php
session_start();

function setConnected($loginPostForm, $passwordPostForm) {
    if (isset($_SESSION)) {
        
        $_SESSION['loginPostForm'] = htmlspecialchars(trim($loginPostForm)); 
        $_SESSION['passwordPostForm'] = htmlspecialchars($passwordPostForm);
    }
}

function isDisconnect() { 
    if (!isset($_SESSION) && !isset($_SESSION['loginPostForm']) && !isset($_SESSION['passwordPostForm'])) {
        return false;
    }else {
        return true;
    }
}

if (isset($_POST) && isset($_POST['pseudo1']) && isset($_POST['mdp1'])) {
    if (!empty($_POST['pseudo1'] && $_POST['mdp1'])) {
        if (is_string($_POST['pseudo1']) && is_string($_POST['mdp1'])) {
            setConnected($_POST['pseudo1'], $_POST['mdp1']);
        }else {
            echo "</br><p style='text-align:center;color:red;'>Votre login ou mot de passe n'est pas une chaîne de caractère !</p>";
        }
    }else {
        echo "</br><p style='text-align:center;color:red;'>Vous n'avez pas renseigné les champs !</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Project EZ</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<!-- Bouton du header permettant l'inscription, la connection, la déconnection & la consultation du profil -->
    <header id="head">
        <?php if(isDisconnect()) { ?>
            <button id="inscription" onclick="openInscription()">inscription</button>
            <button id="connection" onclick="openConnect()">Connection</button>
        <?php }else{ ?>
            <button id="deconnection">Deconnection</button>
            <button id="profil" onclick="openProfil()">Profil</button>
        <?php } ?>
        <h1 id="titre">LE FORUM DES GEEKEZ</h1>
    </header>
    
    <br><hr>
    
<!-- Modal d'inscription -->
    <div class="modal" id="modal1">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeInscription()">X</span></div>
    <h2 style="text-align:center">-- Formulaire d'Inscription --</h2>
    <form class="form" action="" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="E-Mail" name="mail">
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp">
    <div style="text-align:center;"><input type="submit" value="S'Inscrire" class="pseudoBtn"></div>
    </form>
    </div>
    
<!-- Modal de connection -->
    <div class="modal" id="modal2">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeConnect()">X</span></div>
    <h2 style="text-align:center">-- Formulaire de Connection --</h2>
    <form class="form" action="" method="post">
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="pseudo1">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp1">
    <div style="text-align:center;"><input type="submit" value="Se Connecter" class="pseudoBtn"></div>
    </form>
    </div>
    
<!-- Modal du Profil -->
    <div class="modal" id="modal3">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeProfil()">X</span></div>
    <h2 style="text-align:center">-- Page du profil --</h2>
    <form action="" method="post">
    <div class="icon" style="display:flex;">
    <div class="tdIcons"><img src="./assets/edit.png" alt="edit" onclick=""></div><h4>Pseudo:</h4>
    </div>
    <div class="icon">
    <div class="tdIcons"><img src="./assets/edit.png" alt="edit" onclick=""></div><h4>Mot de Passe:</h4>
    </div>
    <h4>Rang:</h4>
    <h4>Nombre de message posté:</h4>
    <div style="text-align:center;"><input name="btnDeleteAccount" type="submit" value="Supprimer son Compte" class="pseudoBtn"></div>
    </form>
    </div>
    
    <br>

<!-- Table des topics & début du forum -->
    <table id="conteneur">
        <tr id="index">
            <td id="colone1">Icone</td>
            <td id="colone2">Nom du Topic</td>
            <td id="colone3">Créateur</td>
            <td id="colone4">Nombre de Msg</td>
            <td id="colone5">Nombre de vues</td>
        </tr>
    </table>
<!-- Tableau ou les topics seront implémenté -->
    <div name="topic" id="topic">
    
    </div>
<!-- Fontion pour les modals -->
    <script>
    function openInscription(){ document.getElementById("modal1").style.display="flex"; }
    function closeInscription(){ document.getElementById("modal1").style.display="none"; }
    function openConnect(){ document.getElementById("modal2").style.display="flex"; }
    function closeConnect(){ document.getElementById("modal2").style.display="none"; }
    function openProfil(){ document.getElementById("modal3").style.display="flex"; }
    function closeProfil(){ document.getElementById("modal3").style.display="none"; }
    </script>

    <script src="assets/index.js"></script>
</body>
</html>