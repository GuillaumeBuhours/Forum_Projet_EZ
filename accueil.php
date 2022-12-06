<?php 
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
    <header id="head">
            <button id="inscription" onclick="openInscription()">inscription</button>
            <button id="connection" onclick="openConnect()">Connection</button>
            <button id="deconnection">Deconnection</button>
            <button id="profil" onclick="openProfil()">Profil</button>
        <h1 id="titre">LE FORUM DES GEEKEZ</h1>
    </header>
    <br><hr>
    <!-- Modal d'inscription -->
    <div class="modal" id="modal1">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeInscription()">X</span></div>
    <h2>-- Formulaire d'Inscription --</h2>
    <input class="pseudoTxtarea" type="text" placeholder="E-Mail" name="mail">
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="name1">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp1">
    <div style="text-align:center;"><span class="pseudoBtn" onclick="">S'inscrire</span></div>
    </div>
    <!-- Modal de connection -->
    <div class="modal" id="modal2">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeConnect()">X</span></div>
    <h2>-- Formulaire de Connection --</h2>
    <input class="pseudoTxtarea" type="text" placeholder="Pseudo" name="name1">
    <input class="pseudoTxtarea" type="text" placeholder="mot de passe" name="mdp1">
    <div style="text-align:center;"><span class="pseudoBtn" onclick="">Se Connecter</span></div>
    </div>
    <!-- Modal du Profil -->
    <div class="modal" id="modal3">
    <div style="width:100%;text-align:right"><span class="closeBtn" onclick="closeProfil()">X</span></div>
    <h2>-- Page du profil --</h2>
    <h4>Pseudo:</h4>
    <h4>Rang:</h4>
    <h4>Nombre de message posté:</h4>
    <div style="text-align:center;"><span class="pseudoBtn" onclick="">Se Connecter</span></div>
    </div>
    <br>
    <table id="conteneur">
        <tr id="index">
            <td id="colone1">Icone</td>
            <td id="colone2">Nom du Topic</td>
            <td id="colone3">Créateur</td>
            <td id="colone4">Nombre de Msg</td>
            <td id="colone5">Nombre de vues</td>
        </tr>
    </table>
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